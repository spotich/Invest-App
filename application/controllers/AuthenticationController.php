<?php

namespace application\controllers;

use application\core\View;
use application\databases\DatabaseMySQL;
use application\models\UserModel;
use JetBrains\PhpStorm\NoReturn;

class AuthenticationController
{
    private UserModel $model;

    public function __construct()
    {
        $database = new DatabaseMySQL();
        $this->model = new UserModel($database);
    }

    public static function getCurrentUserData(): array|null
    {
        if (session_status() === PHP_SESSION_ACTIVE and isset($_SESSION['authenticated'])) {
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

    public function authenticateUser(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE and isset($_SESSION['authenticated'])) {
            View::redirect('/profile');
        } elseif (isset($_POST['email']) and isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->model->getUserByEmail($email);
            if (is_null($user)) {
                echo 'Unknown user';
                exit;
            } elseif (md5($password) == $user['password']) {
                $this->twoFactor($user);
                $_SESSION['authenticated'] = true;
                $_SESSION['name'] = $user['name'];
                $_SESSION['surname'] = $user['surname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                View::redirect('/profile');
            } else {
                echo 'Wrong password';
                exit;
            }
        }
    }

    #[NoReturn] public function logoutUser(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE and isset($_SESSION['authenticated'])) {
            session_unset();
            session_destroy();
        }
        View::redirect('/');
    }

    private function twoFactor($user) {
        if(isset($user['tfa'])) {
            extract($user);
            $to = $email;
            $subject = 'User verification';
            ob_start();
            require dirname(__DIR__, 1) . "/views/layouts/letter.php";
            $message = ob_get_clean();
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            $result = mail($to, $subject, $message, implode("\r\n", $headers));
        } else {
            return null;
        }
    }

    public function registerUser(): void
    {
        //..
    }

}