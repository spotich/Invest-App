<?php

namespace InvestApp\application\controllers;

use InvestApp\application\core\View;
use InvestApp\application\models\User;

class SessionController
{
    private View $view;

    public static function getCurrentUser(): ?User
    {
        return (isset($_SESSION['user']) and ($_SESSION['user'] instanceof User)) ? $_SESSION['user'] : null;
    }

    public static function setCurrentUser(User $currentUser): void
    {
        $_SESSION['user'] = $currentUser;
    }

    public function forgetCurrenUser(): void
    {
        unset($_SESSION['user']);
        $this->view = new View();
        $this->view->redirectToUrl('/');
    }
}