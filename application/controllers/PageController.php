<?php

namespace application\controllers;

use application\core\View;

class PageController
{
    public static function showHome(): void
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

    public static function showError($code): void
    {
        View::errorCode($code);
    }
}