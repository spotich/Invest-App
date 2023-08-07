<?php

use application\controllers\PageController;
use application\controllers\AuthenticationController;
use application\controllers\SessionController;

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

    '/^register$/' => [
        'controller' => AuthenticationController::class,
        'action' => 'createRegistrationRequest',
    ],

    '/^authenticate$/' => [
        'controller' => AuthenticationController::class,
        'action' => 'createAuthenticationRequest',
    ],

    '/^authenticate\/(\d+-[a-zA-Z0-9]{40})$/' => [
        'controller' => AuthenticationController::class,
        'action' => 'processAuthenticationRequest',
    ],

    '/^logout$/' => [
        'controller' => SessionController::class,
        'action' => 'clearCurrentUserData',
    ],

    '/^reset/' => [
        'controller' => PageController::class,
        'action' => 'showResetPasswordPage',
    ],
];