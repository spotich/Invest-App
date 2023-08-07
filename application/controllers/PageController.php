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
        $userData = SessionController::getCurrentUserData();
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

    public static function showVerifyPage($email): void {
        if (SessionController::isCurrentUserActive()) {
            View::redirect('/profile');
        } else {
            $vars = [
                'title' => 'Verify',
                'menu' => 'anon',
                'email' => $email,
            ];
            View::render('verify', $vars);
        }
    }

    public static function showLoginPage() {
        if (SessionController::isCurrentUserActive()) {
            View::redirect('/profile');
        } else {
            $vars = [
                'title' => 'Sign in',
                'menu' => 'anon',
                'message' => '',
            ];
            View::render('login', $vars);
        }
    }

    public static function showSignupPage() {
        if (SessionController::isCurrentUserActive()) {
            View::redirect('/profile');
        } else {
            $vars = [
                'title' => 'Sign up',
                'menu' => 'anon',
                'message' => '',
            ];
            View::render('signup', $vars);
        }
    }

    public static function showResetPasswordPage() {
        if (SessionController::isCurrentUserActive()) {
            View::redirect('/profile');
        } else {
            $vars = [
                'title' => 'Reset',
                'menu' => 'anon',
                'message' => '',
            ];
            View::render('reset', $vars);
        }
    }

    public static function showErrorPage($code): void {
        View::errorCode($code);
    }
}