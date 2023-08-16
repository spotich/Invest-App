<?php

namespace InvestApp\application\controllers;

use InvestApp\application\core\View;
use InvestApp\application\models\User;

class ProfileController
{
    public function showProfile(): void
    {
        if (isset($_POST['oldPassword']) and isset($_POST['password']) and isset($_POST['repeatPassword'])) {
            $passwords = [
                'old' => $_POST['oldPassword'],
                'new' => $_POST['password'],
            ];
            $this->updatePassword($passwords);
        } else {
            $publicData = SessionController::getCurrentUserData();
            if (is_null($publicData)) {
                View::redirect('/login');
            } else {
                $vars = [
                    'title' => 'Profile',
                    'menu' => 'auth',
                    'user' => $publicData,
                ];
                View::render('profile', $vars);
            }
        }
    }

    public function updatePassword($passwords): void
    {
        $publicData = SessionController::getCurrentUserData();
        $user = User::findByEmail($publicData['email']);
        $vars = [
            'title' => 'Profile',
            'menu' => 'auth',
            'user' => $publicData,
        ];
        if (md5($passwords['old']) === $user->password) {
            $user->password = md5($passwords['new']);
            $user->save();
        } else {
            $message = "Old password is invalid";
            $vars['message'] = $message;
        }
        View::render('profile', $vars);
    }
}