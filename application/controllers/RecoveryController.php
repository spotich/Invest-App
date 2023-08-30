<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\ConfirmationPageView;
use InvestApp\application\views\RecoveryPageView;
use InvestApp\application\traits\SendingEmailTrait;
use InvestApp\application\models\User;
use InvestApp\application\views\MenuView;
use InvestApp\application\views\PageView;

class RecoveryController
{
    use SendingEmailTrait;

    private MenuView $menuView;
    private RecoveryPageView $recoveryView;
    private PageView $pageView;

    public function __construct()
    {
        $this->menuView = new MenuView();
        $this->recoveryView = new RecoveryPageView();
        $this->pageView = new PageView();
    }

    public function index(): void
    {
        if (isset($_POST['email'])) {
            $this->createRecoveryRequest($_POST['email']);
        } elseif (isset($_POST['password'])) {
            $this->changePassword($_POST['password']);
            $this->pageView->redirectToUrl('/profile');
        } else {
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
        }
    }

    private function createRecoveryRequest(string $email): void
    {
        $user = $this->getUserDetails($email);
        $this->provideRecoveryLinkToUser($user);
        $this->showEmailInstructionToUser($user->email);
    }

    private function getUserDetails(string $email)
    {
        if (is_null($user = User::findByEmail($email))) {
            $this->recoveryView->setMessage('User not found');
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
            exit;
        } else {
            SessionController::setCurrentUser($user);
            return $user;
        }
    }

    private function provideRecoveryLinkToUser(User $user): void
    {
        $expirationTime = date('Y-m-d H:i:s', time() + 5 * 60);
        $recoveryCode = bin2hex(random_bytes(20));
        $user->setRecoveryCode($recoveryCode, $expirationTime);
        if (!$this->sendRecoverEmail($user->email, $recoveryCode)) {
            $this->recoveryView->setMessage('Failed to send an email');
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
            exit;
        }
    }

    private function showEmailInstructionToUser(string $email)
    {
        $confirmationView = new ConfirmationPageView();
        $this->pageView->renderPage('Confirm', $this->menuView->getMenu(),
            $confirmationView->getContent(
                'Check your email',
                $email,
                'Follow the link in letter to recover the password'
            )
        );
    }

    private function changePassword(string $password): void
    {
        if (is_null($user = SessionController::getCurrentUser())) {
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
        } else {
            $user->password = md5($password);
            $user->save();
            SessionController::setCurrentUser($user);
        }
    }

    public function verifyRecovery($recoveryCode): void
    {
        if (is_null($user = SessionController::getCurrentUser())) {
            $errorMessage = '';
        }
        if (is_null($resetData = $user->getResetData())) {
            $errorMessage = 'Invalid recovery request';
        }
        if ($resetData->resetCode !== $recoveryCode) {
            $errorMessage = 'Invalid recovery code';
        }
        if ($resetData->expirationTime < date('Y-m-d H:i:s', time())) {
            $errorMessage = 'Recovery request timed out';
        }

        if (isset($errorMessage)) {
            $this->recoveryView->setMessage($errorMessage);
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
        } else {
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getNewPasswordPageContent());
        }
    }
}