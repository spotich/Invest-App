<?php

namespace application\controllers;

use application\core\View;

class PageController
{
    public static function showHome(): void
    {
        $userData = AuthenticationController::getCurrentUserData();
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

    public static function showProfile(): void
    {
        $userData = AuthenticationController::getCurrentUserData();
        if(is_null($userData)) {
            View::redirect('/');
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