<?php

use application\controllers\PageController;
use application\controllers\AuthenticationController;

return [
    '' => [
        'controller' => PageController::class,
        'action' => 'showHome',
    ],

    'profile' => [
        'controller' => PageController::class,
        'action' => 'showProfile',
    ],

    'login' => [
        'controller' => AuthenticationController::class,
        'action' => 'authenticateUser',
    ],

    'logout' => [
        'controller' => AuthenticationController::class,
        'action' => 'logoutUser',
    ],

    'register' => [
        'controller' => AuthenticationController::class,
        'action' => 'registerUser',
    ],
];