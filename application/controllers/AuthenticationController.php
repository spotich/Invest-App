<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\ConfirmationView;
use InvestApp\application\traits\FetchingGuestDataTrait;
use InvestApp\application\views\AuthenticationView;
use InvestApp\application\traits\SendingEmailTrait;
use InvestApp\application\models\User;
use InvestApp\application\views\MenuView;
use InvestApp\application\views\PageView;
use stdClass;

class AuthenticationController
{
    use SendingEmailTrait;
    use FetchingGuestDataTrait;

    private ?User $user = null;
    private ?stdClass $guest = null;
    private MenuView $menuView;
    private AuthenticationView $authenticationView;
    private ConfirmationView $confirmationView;
    private PageView $pageView;

    public function __construct()
    {
        $this->menuView = new MenuView($this->user);
        $this->authenticationView = new AuthenticationView();
        $this->pageView = new PageView();
        $this->confirmationView = new ConfirmationView();
    }

    public function index(): void
    {
        $this->guest = $this->fetchGuestData();
        if (is_null($this->guest)) {
            $this->pageView->renderPage('Login', $this->menuView->getMenu(), $this->authenticationView->getContent());
            return;
        }

        $this->user = User::findByEmail($this->guest->email);
        if (is_null($this->user)) {
            $this->authenticationView->setMessage('User not found');
            $this->pageView->renderPage('Login', $this->menuView->getMenu(), $this->authenticationView->getContent());
            return;
        }

        if (md5($this->guest->password) !== $this->user->password) {
            $this->authenticationView->setMessage('Wrong password');
            $this->pageView->renderPage('Login', $this->menuView->getMenu(), $this->authenticationView->getContent());
            return;
        }

        $this->authenticateUser();
    }

    private function authenticateUser(): void
    {
        if ($this->user->isUptoDate()) {
            $this->user->getAvatar();
            SessionController::setCurrentUser($this->user);
            $this->pageView->redirectToUrl('/profile');
        }

        $verificationCode = bin2hex(random_bytes(20));
        $this->user->setVerificationCode($verificationCode);

        if (!$this->sendVerificationEmail($this->user->email, $verificationCode)) {
            $this->authenticationView->setMessage('Failed to send an email');
            $this->pageView->renderPage('Login', $this->menuView->getMenu(), $this->authenticationView->getContent());
            return;
        }

        $this->pageView->renderPage('Confirm', $this->menuView->getMenu(),
            $this->confirmationView->getContent('Check your email', $this->user->email,
                'Follow the link in the letter to confirm your email'
            ));
    }

    public function verifyUser($verificationCode): void
    {
        $this->user = SessionController::getCurrentUser();
        if (is_null($this->user)) {
            $this->pageView->renderErrorPage(404);
        }

        if ($this->user->getAuthenticationCode() !== $verificationCode) {
            $this->pageView->renderErrorPage(404);
        }

        $expirationTime = date('Y-m-d H:i:s', time() + 7 * 24 * 60 * 60);
        $this->user->setExpirationTime($expirationTime);
        $this->user->getAvatar();
        SessionController::setCurrentUser($this->user);
        $this->pageView->redirectToUrl('/profile');
    }
}