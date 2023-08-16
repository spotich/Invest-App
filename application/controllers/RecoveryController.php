<?php

namespace InvestApp\application\controllers;

use InvestApp\application\core\View;
use InvestApp\application\traits\EmailTrait;
use InvestApp\application\models\User;

class RecoveryController
{
    use EmailTrait;

    public function createRecoverRequest()
    {
        if (isset($_SESSION['verified']) and $_SESSION['verified']) {
            unset($_SESSION['verified']);
            $vars = [
                'title' => 'New password',
                'menu' => 'anon',
            ];
            View::render('newPassword', $vars);
        } elseif (isset($_POST['email'])) {
            $user = User::findByEmail($_POST['email']);
            if (is_null($user)) {
                $message = 'User not found';
                $vars = [
                    'title' => 'Recovery',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('recover', $vars);
            } else {
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['reset_request'] = 'created';
                $_SESSION['reset_code'] = $user->newResetCode();
                $emailVars = [
                    'to' => $user->email,
                    'subject' => 'Password recovery',
                    'title' => 'Recover password',
                    'content' => 'Did you forget your password? If so, follow the link below.',
                    'link_href' => PROTOCOL . '//' . HOSTNAME . '/recover/' . $user->id . '-' . $_SESSION['reset_code'],
                    'link_text' => 'Recover',
                ];
                if (self::sendEmail($emailVars)) {
                    $vars = [
                        'title' => 'Recovery',
                        'menu' => 'anon',
                        'pageTitle' => 'Check your email',
                        'email' => $user->email,
                        'pageContent' => 'Follow the link in letter to recover the password',
                    ];
                    View::render('emailSent', $vars);
                } else {
                    PageController::showError(404);
                }
            }
        } elseif (isset($_POST['password']) and isset($_POST['repeatPassword']) and isset($_SESSION['email'])) {
            $user = User::findByEmail($_SESSION['email']);
            $user->password = md5($_POST['password']);
            $user->save();
            SessionController::setCurrentUserData($user->serializeToArray());
            View::redirect('/profile');
        } else {
            $vars = [
                'title' => 'Recovery',
                'menu' => 'anon',
            ];
            View::render('recover', $vars);
        }
    }

    public function processRecoverRequest($resetCombination)
    {
        if ($_SESSION['reset_request'] === 'created') {
            $pattern = '/^(\d+)-([a-zA-Z0-9]{40})$/';
            if (preg_match($pattern, $resetCombination, $matches)) {
                $user_id = (int)$matches[1];
                $reset_code = $matches[2];
                if ($_SESSION['reset_code'] === $reset_code) {
                    $user = User::findById($user_id);
                    $resetData = $user->getResetData();
                    if (is_null($resetData)) {
                        echo 'Reset code doesnt exist';
                        exit;
                    } elseif ($resetData[0]['reset_code'] == $_SESSION['reset_code'] and $resetData[0]['expiration_time'] > date('Y-m-d H:i:s', time())) {
                        unset($_SESSION['reset_request']);
                        $_SESSION['verified'] = true;
                        View::redirect('/recover');
                    } else {
                        echo 'Reset code is inactive';
                        exit;
                    }
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
}