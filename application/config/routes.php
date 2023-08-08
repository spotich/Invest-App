<?php

use application\controllers\PageController;
use application\controllers\AuthenticationController;
use application\controllers\SessionController;
use application\controllers\RecoveryController;

return [
    '/^$/' => [
        'controller' => PageController::class,
        'action' => 'showHomePage',
    ],

    '/^profile$/' => [
        'controller' => PageController::class,
        'action' => 'showProfilePage',
    ],

    '/^login$/' => [
        'controller' => PageController::class,
        'action' => 'showLoginPage',
    ],

    '/^signup$/' => [
        'controller' => PageController::class,
        'action' => 'showSignupPage',
    ],

    '/^recovery$/' => [
        'controller' => PageController::class,
        'action' => 'showRecoveryPage',
    ],

    '/^register$/' => [
        'controller' => AuthenticationController::class,
        'action' => 'registerUser',
    ],

    '/^authenticate$/' => [
        'controller' => AuthenticationController::class,
        'action' => 'createAuthenticationRequest',
    ],

    '/^authenticate\/(\d+-[a-zA-Z0-9]{40})$/' => [
        'controller' => AuthenticationController::class,
        'action' => 'processAuthenticationRequest',
    ],

    '/^recover$/' => [
        'controller' => RecoveryController::class,
        'action' => 'createRecoverRequest',
    ],

    '/^recover\/(\d+-[a-zA-Z0-9]{40})$/' => [
        'controller' => RecoveryController::class,
        'action' => 'processRecoverRequest',
    ],

    '/^logout$/' => [
        'controller' => SessionController::class,
        'action' => 'clearCurrentUserData',
    ],

    '/^newPassword$/' => [
        'controller' => PageController::class,
        'action' => 'showNewPasswordPage',
    ],
];