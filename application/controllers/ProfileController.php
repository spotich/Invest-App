<?php

namespace application\controllers;

use application\core\View;
use application\databases\DatabaseMySQL;
use application\models\UserModel;

class ProfileController
{
    private static UserModel $model;

    public function __construct()
    {
        $database = new DatabaseMySQL();
        self::$model = new UserModel($database);
    }

    public function updatePassword($passwords): void
    {
        $user = SessionController::getCurrentUserData();
        $user = self::$model->getUserByEmail($user['email']);
        $vars = [
            'title' => 'Profile',
            'menu' => 'auth',
            'user' => $user,
        ];
        if (md5($passwords['old']) === $user['password']) {
            self::$model->updatePasswordForUser(md5($passwords['new']), $user['id']);
        } else {
            $message = "Old password is invalid";
            $vars['message'] = $message;
        }
        View::render('profile', $vars);
    }
}