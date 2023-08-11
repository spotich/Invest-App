<?php

use application\controllers\PageController;
use application\controllers\AuthenticationController;
use application\controllers\SessionController;
use application\controllers\RecoveryController;
use application\controllers\ProfileController;
use application\controllers\ProjectController;

return [
    '/^$/' => [
        'controller' => PageController::class,
        'action' => 'showHome',
    ],

    '/^projects$/' => [
        'controller' => ProjectController::class,
        'action' => 'showProjects',
    ],

    '/^projects\/(\d+)$/' => [
        'controller' => ProjectController::class,
        'action' => 'showDetailedProject',
    ],

    '/^profile$/' => [
        'controller' => ProfileController::class,
        'action' => 'showProfile',
    ],

    '/^register$/' => [
        'controller' => AuthenticationController::class,
        'action' => 'registerUser',
    ],

    '/^login$/' => [
        'controller' => AuthenticationController::class,
        'action' => 'createAuthenticationRequest',
    ],

    '/^login\/(\d+-[a-zA-Z0-9]{40})$/' => [
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
];