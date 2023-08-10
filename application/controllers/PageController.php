<?php

namespace application\controllers;

use application\core\View;

class PageController
{
    public static function showHomePage(): void
    {
        $userData = SessionController::getCurrentUserData();
        if (is_null($userData)) {
            $vars = [
                'title' => 'Home',
                'menu' => 'anon',
            ];
        } else {
            $vars = [
                'title' => 'Home',
                'menu' => 'auth',
                'user' => $userData,
            ];
        }
        View::render('home', $vars);
    }

    public static function showProfilePage(): void
    {
        if (isset($_POST['oldPassword']) and isset($_POST['password']) and isset($_POST['repeatPassword'])) {
            $passwords = [
                'old' => $_POST['oldPassword'],
                'new' => $_POST['password'],
            ];
            $profileController = new ProfileController();
            $profileController->updatePassword($passwords);
        } else {
            $userData = SessionController::getCurrentUserData();
            if (is_null($userData)) {
                View::redirect('/login');
            } else {
                $vars = [
                    'title' => 'Profile',
                    'menu' => 'auth',
                    'user' => $userData,
                ];
                View::render('profile', $vars);
            }
        }
    }

    public static function showErrorPage($code): void
    {
        View::errorCode($code);
    }
}