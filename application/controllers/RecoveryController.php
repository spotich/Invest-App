<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\ConfirmationView;
use InvestApp\application\views\RecoveryView;
use InvestApp\application\traits\SendingEmailTrait;
use InvestApp\application\models\User;
use InvestApp\application\views\MenuView;
use InvestApp\application\views\PageView;

class RecoveryController
{
    use SendingEmailTrait;

    private ?User $user = null;
    private MenuView $menuView;
    private RecoveryView $recoveryView;
    private PageView $pageView;
    private ConfirmationView $confirmationView;

    public function __construct()
    {
        $this->menuView = new MenuView($this->user);
        $this->recoveryView = new RecoveryView();
        $this->pageView = new PageView();
        $this->confirmationView = new ConfirmationView();
    }

    public function index(): void
    {
        if (isset($_POST['email'])) {
            $this->user = User::findByEmail($_POST['email']);
            if (is_null($this->user)) {
                $this->recoveryView->setMessage('User not found');
                $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
                return;
            }
            SessionController::setCurrentUser($this->user);
            $expirationTime = date('Y-m-d H:i:s', time() + 5 * 60);
            $recoveryCode = bin2hex(random_bytes(20));
            $this->user->setRecoveryCode($recoveryCode, $expirationTime);

            if (!$this->sendRecoverEmail($this->user->email, $recoveryCode)) {
                $this->recoveryView->setMessage('Failed to send an email');
                $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
                return;
            }

            $this->pageView->renderPage('Confirm', $this->menuView->getMenu(),
                $this->confirmationView->getContent('Check your email', $this->user->email,
                    'Follow the link in letter to recover the password'
                ));
            return;
        }

        if (isset($_POST['password'])) {
            $this->user = SessionController::getCurrentUser();
            if (is_null($this->user)) {
                $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
                return;
            }
            $this->changePassword($_POST['password']);
            return;
        }

        $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
    }

    private function changePassword(string $password): void
    {
        $this->user->password = md5($password);
        $this->user->save();
        SessionController::setCurrentUser($this->user);
        $this->pageView->redirectToUrl('/profile');
    }

    public function verifyRecovery($recoveryCode): void
    {
        $this->user = SessionController::getCurrentUser();
        if (is_null($this->user)) {
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
            return;
        }

        $resetData = $this->user->getResetData();
        if (is_null($resetData)) {
            $this->recoveryView->setMessage('Invalid recovery request');
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
            return;
        }

        if ($resetData->resetCode !== $recoveryCode) {
            $this->recoveryView->setMessage('Invalid recovery code');
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
            return;
        }

        if ($resetData->expirationTime < date('Y-m-d H:i:s', time())) {
            $this->recoveryView->setMessage('Recovery request timed out');
            $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getRecoveryPageContent());
        }

        $this->pageView->renderPage('Recovery', $this->menuView->getMenu(), $this->recoveryView->getNewPasswordPageContent());
    }
}