<?php

namespace InvestApp\application\controllers;

use InvestApp\application\traits\FetchingGuestDataTrait;
use InvestApp\application\traits\SendingEmailTrait;
use InvestApp\application\models\User;
use InvestApp\application\views\MenuView;
use InvestApp\application\views\PageView;
use InvestApp\application\views\RegistrationPageView;
use stdClass;

class RegistrationController
{
    use SendingEmailTrait;
    use FetchingGuestDataTrait;

    private ?User $user = null;
    private ?stdClass $guest = null;
    private MenuView $menuView;
    private RegistrationPageView $registrationView;
    private PageView $pageView;

    public function __construct()
    {
        $this->menuView = new MenuView($this->user);
        $this->registrationView = new RegistrationPageView();
        $this->pageView = new PageView();
    }

    public function registerUser(): void
    {
        $this->guest = $this->fetchGuestData();
        if (is_null($this->guest)) {
            $this->pageView->renderPage('Register', $this->menuView->getMenu(), $this->registrationView->getContent());
            return;
        }

        $this->user = User::findByEmail($this->guest->email);
        if (!is_null($this->user)) {
            $this->registrationView->setMessage('This email is taken already');
            $this->pageView->renderPage('Register', $this->menuView->getMenu(), $this->registrationView->getContent());
            return;
        }

        $_POST['password'] = md5($_POST['password']);
        $this->user = User::toObject($_POST);
        $this->user->save();

        $verificationCode = bin2hex(random_bytes(20));
        $this->user->setVerificationCode($verificationCode);

        if (!$this->sendVerificationEmail($this->user->email, $verificationCode)) {
            $this->registrationView->setMessage('Failed to send an email');
            $this->pageView->renderPage('Register', $this->menuView->getMenu(), $this->registrationView->getContent());
        }
    }
}