<?php

namespace application\controllers;

use application\core\View;
use JetBrains\PhpStorm\NoReturn;

class SessionController
{
    public static function getCurrentUserData(): array|null
    {
        if (SessionController::isCurrentUserActive()) {
            $userData = [
                'name' => $_SESSION['name'],
                'surname' => $_SESSION['surname'],
                'email' => $_SESSION['email'],
                'role' => $_SESSION['role'],
            ];
        } else {
            $userData = null;
        }
        return $userData;
    }

    public static function setCurrentUserData($currentUser): bool
    {
        $ok = (isset($currentUser['name']) and isset($currentUser['surname']) and isset($currentUser['email']) and isset($currentUser['password']));
        if ($ok) {
            $_SESSION['authenticated'] = true;
            $_SESSION['name'] = $currentUser['name'];
            $_SESSION['surname'] = $currentUser['surname'];
            $_SESSION['email'] = $currentUser['email'];
            $_SESSION['role'] = $currentUser['role'];
        }
        return $ok;
    }

    #[NoReturn] public static function clearCurrentUserData():void
    {
        if (SessionController::isCurrentUserActive()) {
            session_unset();
            session_destroy();
        }
        View::redirect('/');
    }

    public static function isCurrentUserActive(): bool
    {
        return (session_status() === PHP_SESSION_ACTIVE and isset($_SESSION['authenticated']) and $_SESSION['authenticated'] === true and isset($_SESSION['name']) and isset($_SESSION['surname']) and isset($_SESSION['email']) and isset($_SESSION['role']));
    }
}