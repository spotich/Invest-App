<?php

namespace application\controllers;

use application\core\View;
use application\databases\DatabaseMySQL;
use application\models\UserModel;


class AuthenticationController
{
    private static UserModel $model;

    public function __construct()
    {
        $database = new DatabaseMySQL();
        self::$model = new UserModel($database);
    }

    public static function createAuthenticationRequest(): void
    {
        if (isset($_POST['email']) and isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = self::$model->getUserByEmail($email);

            if (is_null($user)) {
                $message = 'User not found';
                $vars = [
                    'title' => 'Sign in',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('login', $vars);
                exit;
            } elseif (md5($password) == $user['password']) {
                if ($user['expiration_time'] < date('Y-m-d H:i:s', time())) {
                    $_SESSION['authentication_request'] = 'created';
                    $user['two_factor_authentication_code'] = self::$model->updateAuthenticationCodeForUser($user['id']);
                    self::sendAuthenticationEmail($user);
                    PageController::showVerifyPage($email);
                } else {
                    SessionController::setCurrentUserData($user);
                    View::redirect('/');
                }
            } else {
                $message = 'Wrong password';
                $vars = [
                    'title' => 'Sign in',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('login', $vars);
            }
        } else {
            View::redirect('/login');
        }
    }

    private static function sendAuthenticationEmail($user)
    {
        if (isset($user['two_factor_authentication_code'])) {
            extract($user);
            $to = $email;
            $subject = 'User authentication';
            ob_start();
            require dirname(__DIR__, 1) . "/views/layouts/letter.php";
            $message = ob_get_clean();
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            $headers[] = 'From: Invest-App <popenko1337@gmail.com>';
            $result = mail($to, $subject, $message, implode("\r\n", $headers));
            if (!$result) {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function processAuthenticationRequest($verificationCode)
    {
        if ($_SESSION['authentication_request'] === 'created') {
            $pattern = '/^(\d+)-([a-zA-Z0-9]{40})$/';
            if (preg_match($pattern, $verificationCode, $matches)) {
                $id = $matches[1];
                $two_factor_authentication_code = $matches[2];
                $user = self::$model->getUserById($id);
                if ($user['two_factor_authentication_code'] === $two_factor_authentication_code) {
                    self::$model->updateExpirationTimeForUser($id);
                    SessionController::setCurrentUserData($user);
                    unset($_SESSION['request']);
                    View::redirect('/profile');
                } else {
                    echo 'Wrong authentication code';
                    exit;
                }
            } else {
                PageController::showErrorPage(404);
            }
        } else {
            PageController::showErrorPage(404);
        }

    }

    public static function createRegistrationRequest(): void
    {
        if (isset($_POST['name']) and isset($_POST['surname']) and isset($_POST['email']) and isset($_POST['role']) and isset($_POST['password']) and isset($_POST['repeatPassword'])) {
            $user = self::$model->getUserByEmail($_POST['email']);

            if (is_null($user)) {
                $user['name'] = $_POST['name'];
                $user['surname'] = $_POST['surname'];
                $user['email'] = $_POST['email'];
                $user['role'] = $_POST['role'];
                $user['password'] = md5($_POST['password']);
                self::$model->createNewUser($user);
                unset($_POST);
                View::redirect('/login');
            } else {
                $message = 'Email address is already taken';
                $vars = [
                    'title' => 'Sign up',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('signup', $vars);
            }
        } else {
            View::redirect('/signup');
        }
    }
}