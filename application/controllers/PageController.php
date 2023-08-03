<?php

namespace application\controllers;

use application\core\View;

class PageController
{
    public static function showHome(): void
    {
        $userData = AuthenticationController::getCurrentUserData();
        if (!empty($userData)) {
            $vars = [
                'title' => 'Home',
                'menu' => 'auth',
                'user' => $userData,
            ];
        } else {
            $vars = [
                'title' => 'Home',
                'menu' => 'anon',
            ];
        }
        View::render('home', $vars);
    }

    public static function showProfile(): void
    {
        $userData = AuthenticationController::getCurrentUserData();
        if (!empty($userData)) {
            $vars = [
                'title' => 'Profile',
                'menu' => 'auth',
                'user' => $userData,
            ];
            View::render('profile', $vars);
        } else {
            View::redirect('/');
        }
    }
}