<?php

namespace application\controllers;

use application\core\View;
use application\databases\DatabaseMySQL;
use application\models\UserModel;
use application\traits\EmailTrait;

class AuthenticationController
{
    use EmailTrait;

    public static UserModel $model;

    public function __construct()
    {
        $database = new DatabaseMySQL();
        self::$model = new UserModel($database);
    }

    public static function createAuthenticationRequest(): void
    {
        if (isset($_POST['email']) and isset($_POST['password'])) {
            $user = self::$model->getUserByEmail($_POST['email']);
            if (is_null($user)) {
                $message = 'User not found';
                $vars = [
                    'title' => 'Login',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('login', $vars);
            } elseif (md5($_POST['password']) == $user['password']) {
                if ($user['expiration_time'] < date('Y-m-d H:i:s', time())) {
                    $_SESSION['authentication_request'] = 'created';
                    $user['two_factor_authentication_code'] = self::$model->updateAuthenticationCodeForUser($user['id']);
                    $emailVars = [
                        'to' => $user['email'],
                        'subject' => 'Email verification',
                        'title' => 'Verify your email',
                        'content' => 'Someone was trying to enter your account. If it was you, follow the link below.',
                        'link_href' => PROTOCOL.'//'.HOSTNAME.'/login/'.$user['id'].'-'.$user['two_factor_authentication_code'],
                        'link_text' => 'Verify',
                    ];
                    if (self::sendEmail($emailVars)) {
                        $vars = [
                            'title' => 'Verify your email',
                            'menu' => 'anon',
                            'pageTitle' => 'Verify your email',
                            'email' => $user['email'],
                            'pageContent' => 'Follow the link in letter to verify your email address',
                        ];
                        View::render('emailSent', $vars);
                    } else {
                        PageController::showErrorPage(404);
                    }
                } else {
                    SessionController::setCurrentUserData($user);
                    View::redirect('/');
                }
            } else {
                $message = 'Wrong password';
                $vars = [
                    'title' => 'Login',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('login', $vars);
            }
        } else {
            $vars = [
                'title' => 'Login',
                'menu' => 'anon'
            ];
            View::render('login', $vars);
        }
    }

    public static function processAuthenticationRequest($verificationCombination)
    {
        if ($_SESSION['authentication_request'] === 'created') {
            $pattern = '/^(\d+)-([a-zA-Z0-9]{40})$/';
            if (preg_match($pattern, $verificationCombination, $matches)) {
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

    public static function registerUser(): void
    {
        if (isset($_POST['name']) and isset($_POST['surname']) and isset($_POST['email']) and isset($_POST['role']) and isset($_POST['password']) and isset($_POST['repeatPassword'])) {
            $user = self::$model->getUserByEmail($_POST['email']);

            if (is_null($user)) {
                $user['name'] = $_POST['name'];
                $user['surname'] = $_POST['surname'];
                $user['email'] = $_POST['email'];
                $user['role'] = $_POST['role'];
                $user['password'] = md5($_POST['password']);
                $user['id'] = self::$model->createNewUser($user);

                unset($_POST);
                $_SESSION['authentication_request'] = 'created';
                $user['two_factor_authentication_code'] = self::$model->updateAuthenticationCodeForUser($user['id']);
                $emailVars = [
                    'to' => $user['email'],
                    'subject' => 'Email verification',
                    'title' => 'Verify your email',
                    'content' => 'Welcome to Invest-App! We are glad that you want to become a member. Follow the link below to verify your email.',
                    'link_href' => PROTOCOL.'//'.HOSTNAME.'/login/'.$user['id'].'-'.$user['two_factor_authentication_code'],
                    'link_text' => 'Verify',
                ];
                if (self::sendEmail($emailVars)) {
                    $vars = [
                        'title' => 'Verify your email',
                        'menu' => 'anon',
                        'pageTitle' => 'Verify your email',
                        'email' => $user['email'],
                        'pageContent' => 'Follow the link in letter to verify your email address',
                    ];
                    View::render('emailSent', $vars);
                } else {
                    PageController::showErrorPage(404);
                }
            } else {
                $message = 'Email address is already taken';
                $vars = [
                    'title' => 'Register',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('register', $vars);
            }
        } else {
            $vars = [
                'title' => 'Register',
                'menu' => 'anon',
            ];
            View::render('register', $vars);
        }
    }
}