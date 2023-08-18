<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\MenuView;
use InvestApp\application\views\ProfileView;
use InvestApp\application\models\User;
use InvestApp\application\views\PageView;
use stdClass;

class ProfileController
{
    private ?User $currentUserData = null;
    private MenuView $menuView;
    private ProfileView $profileView;
    private PageView $pageView;

    public function __construct()
    {
        $this->pageView = new PageView();
    }

    public function index(): void
    {
        $this->currentUserData = SessionController::getCurrentUser();
        if (is_null($this->currentUserData)) {
            $this->pageView->redirectToUrl('/login');
        }
        if (isset($_POST['oldPassword']) and isset($_POST['password']) and isset($_POST['repeatPassword'])) {
            $passwords = new stdClass();
            $passwords->old = $_POST['oldPassword'];
            $passwords->new = $_POST['password'];
            $this->updatePassword($passwords);
            return;
        }
        $this->showProfilePage();
    }

    private function updatePassword(stdClass $passwords): void
    {
        $user = User::findByEmail($this->currentUserData->email);
        if (is_null($user)) {
            $this->pageView->redirectToUrl('/register');
        }

        if (md5($passwords->old) !== $user->password) {
            $this->showProfilePage('Old password is invalid');
            return;
        }

        $user->password = md5($passwords->new);
        $user->save();
        $this->showProfilePage();
    }

    private function showProfilePage(string $message = ''): void
    {
        $this->menuView = new MenuView($this->currentUserData);
        $this->profileView = new ProfileView($this->currentUserData);
        $this->pageView->setMessage($message);
        $this->pageView->renderPage('Profile', $this->menuView->getMenu(), $this->profileView->getContent());
    }
}