<?php

namespace application\controllers;

use application\core\View;
use application\databases\DatabaseMySQL;
use application\models\UserModel;

class AuthenticationController
{
    private UserModel $model;

    public function __construct()
    {
        $database = new DatabaseMySQL();
        $this->model = new UserModel($database);
    }

    public static function  getCurrentUserData(): array {
        if (session_status() === PHP_SESSION_ACTIVE and isset($_SESSION['auth'])) {
            $userData = [
                'name' => $_SESSION['name'],
                'surname' => $_SESSION['surname'],
                'email' => $_SESSION['email'],
                'role' => $_SESSION['role'],
            ];
        } else {
            $userData = [];
        }
        return $userData;
    }

    public function authenticateUser(): void
    {
        if (empty($_POST)) {
            if (session_status() === PHP_SESSION_ACTIVE) {
                View::redirect('/profile');
            }
        } else {
            if (!empty($_POST)) {
                $email = empty($_POST['email']) ? null : $_POST['email'];
                $password = empty($_POST['password']) ? null : $_POST['password'];
                $user = $this->model->getUserByEmail($email);

                if (md5($password) == $user['password']) {
                    $_SESSION['authenticated'] = true;
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['surname'] = $user['surname'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    View::redirect('/profile');
                }
            }
        }
    }

    public function logoutUser(): void {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
        View::redirect('/');
    }

    public function registerUser(): void
    {
        // ..
    }
}