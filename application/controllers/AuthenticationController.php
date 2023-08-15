<?php

namespace application\controllers;

use application\core\View;
use application\traits\EmailTrait;
use application\models\User;

class AuthenticationController
{
    use EmailTrait;

    public function createAuthenticationRequest(): void
    {
        if (isset($_POST['email']) and isset($_POST['password'])) {
            $user = User::findByEmail($_POST['email']);
            if (is_null($user)) {
                $message = 'User not found';
                $vars = [
                    'title' => 'Login',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('login', $vars);
            } elseif (md5($_POST['password']) === $user->password) {
                if ($user->is_expired()) {
                    $_SESSION['authentication_request'] = 'created';
                    $code = $user->newAuthenticationCode();
                    $emailVars = [
                        'to' => $user->email,
                        'subject' => 'Email verification',
                        'title' => 'Verify your email',
                        'content' => 'Someone was trying to enter your account. If it was you, follow the link below.',
                        'link_href' => PROTOCOL.'//'.HOSTNAME.'/login/'.$user->id.'-'.$code,
                        'link_text' => 'Verify',
                    ];
                    if (self::sendEmail($emailVars)) {
                        $vars = [
                            'title' => 'Verify your email',
                            'menu' => 'anon',
                            'pageTitle' => 'Verify your email',
                            'email' => $user->email,
                            'pageContent' => 'Follow the link in letter to verify your email address',
                        ];
                        View::render('emailSent', $vars);
                    } else {
                        PageController::showError(404);
                    }
                } else {
                    $user->getAvatar();
                    SessionController::setCurrentUserData($user->serializeToArray());
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

    public function processAuthenticationRequest($verificationCombination)
    {
        if ($_SESSION['authentication_request'] === 'created') {
            $pattern = '/^(\d+)-([a-zA-Z0-9]{40})$/';
            if (preg_match($pattern, $verificationCombination, $matches)) {
                $id = $matches[1];
                $code = $matches[2];
                $user = User::findById($id);
                if ($user->getAuthenticationCode() === $code) {
                    $user->newExpirationTime();
                    SessionController::setCurrentUserData($user->serializeToArray());
                    unset($_SESSION['request']);
                    View::redirect('/profile');
                } else {
                    echo 'Wrong authentication code';
                    exit;
                }
            } else {
                PageController::showError(404);
            }
        } else {
            PageController::showError(404);
        }
    }

    public function registerUser(): void
    {
        if (isset($_POST['name']) and isset($_POST['surname']) and isset($_POST['email']) and isset($_POST['role']) and isset($_POST['password']) and isset($_POST['repeatPassword'])) {
            $user = User::findByEmail($_POST['email']);
            if (is_null($user)) {
                $_POST['password'] = md5($_POST['password']);
                $user = User::deserializeFromArray($_POST);
                $user->save();
                unset($_POST);
                $_SESSION['authentication_request'] = 'created';
                $code = $user->getAuthenticationCode();
                $emailVars = [
                    'to' => $user->email,
                    'subject' => 'Email verification',
                    'title' => 'Verify your email',
                    'content' => 'Welcome to Invest-App! We are glad that you want to become a member. Follow the link below to verify your email.',
                    'link_href' => PROTOCOL.'//'.HOSTNAME.'/login/'.$user->id.'-'.$code,
                    'link_text' => 'Verify',
                ];
                if (self::sendEmail($emailVars)) {
                    $vars = [
                        'title' => 'Verify your email',
                        'menu' => 'anon',
                        'pageTitle' => 'Verify your email',
                        'email' => $user->email,
                        'pageContent' => 'Follow the link in letter to verify your email address',
                    ];
                    View::render('emailSent', $vars);
                } else {
                    PageController::showError(404);
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