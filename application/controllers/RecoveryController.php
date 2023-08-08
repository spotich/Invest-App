<?php

namespace application\controllers;

use application\core\View;
use application\databases\DatabaseMySQL;
use application\models\UserModel;
use application\traits\EmailTrait;

class RecoveryController
{
    use EmailTrait;

    private static UserModel $model;

    public function __construct()
    {
        $database = new DatabaseMySQL();
        self::$model = new UserModel($database);
    }

    public static function createRecoverRequest()
    {
        if (isset($_POST['email'])) {
            $user = self::$model->getUserByEmail($_POST['email']);
            if (is_null($user)) {
                $message = 'User not found';
                $vars = [
                    'title' => 'Recover',
                    'menu' => 'anon',
                    'message' => $message,
                ];
                View::render('recover', $vars);
            } else {
                $_SESSION['reset_request'] = 'created';
                $_SESSION['reset_code'] = self::$model->createResetCodeForUser($user['id']);
                $emailVars = [
                    'to' => $user['email'],
                    'subject' => 'Password recovery',
                    'title' => 'Recover password',
                    'content' => 'Did you forget your password? If so, follow the link below.',
                    'link_href' => PROTOCOL.'//'.HOSTNAME.'/recover/'.$user['id'].'-'.$_SESSION['reset_code'],
                    'link_text' => 'Recover',
                ];
                if (self::sendEmail($emailVars)) {
                    $vars = [
                        'title' => 'Email sent',
                        'menu' => 'anon',
                        'pageTitle' => 'Check your email',
                        'email' => $user['email'],
                        'pageContent' => 'Follow the link in letter to recover the password',
                    ];
                    View::render('emailSent', $vars);
                } else {
                    PageController::showErrorPage(404);
                }
            }
        }
    }

    public static function processRecoverRequest($resetCombination) {
        if ($_SESSION['reset_request'] === 'created') {
            $pattern = '/^(\d+)-([a-zA-Z0-9]{40})$/';
            if (preg_match($pattern, $resetCombination, $matches)) {
                $user_id = $matches[1];
                $reset_code = $matches[2];

                if ($_SESSION['reset_code'] === $reset_code) {
                    $resetData = self::$model->getResetDataForUser($user_id);

                    if (!$resetData) {
                        echo 'reset_code doesnt exist';
                        exit;
                    } elseif ($resetData[0]['reset_code'] == $_SESSION['reset_code'] and $resetData[0]['expiration_time'] > date('Y-m-d H:i:s', time())) {
                        unset($_SESSION['reset_request']);
                        View::redirect('/newPassword');
                    } else {
                        echo 'reset_code inactive';
                    }
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
}