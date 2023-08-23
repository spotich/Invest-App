<?php

use InvestApp\application\controllers\HomeController;
use InvestApp\application\controllers\AuthenticationController;
use InvestApp\application\controllers\RegistrationController;
use InvestApp\application\controllers\SessionController;
use InvestApp\application\controllers\RecoveryController;
use InvestApp\application\controllers\ProfileController;
use InvestApp\application\controllers\ProjectController;
use InvestApp\application\controllers\AdminController;

return [
    '#^$#' => [
        'controller' => HomeController::class,
        'action' => 'index',
    ],

    '#^projects$#' => [
        'controller' => ProjectController::class,
        'action' => 'showAllProjects',
    ],

    '#^projects\/(\d+)$#' => [
        'controller' => ProjectController::class,
        'action' => 'showDetailedProject',
    ],

    '#^create$#' => [
        'controller' => ProjectController::class,
        'action' => 'createProject',
    ],

    '#^requests$#' => [
        'controller' => AdminController::class,
        'action' => 'showAllRequests',
    ],

    '#^requests\/(\d+)$#' => [
        'controller' => AdminController::class,
        'action' => 'showDetailedRequest',
    ],

    '#^requests\/(\d+)/status$#' => [
        'controller' => AdminController::class,
        'action' => 'handleRequestStatus',
    ],

    '#^profile$#' => [
        'controller' => ProfileController::class,
        'action' => 'index',
    ],

    '#^register$#' => [
        'controller' => RegistrationController::class,
        'action' => 'registerUser',
    ],

    '#^login$#' => [
        'controller' => AuthenticationController::class,
        'action' => 'index',
    ],

    '#^verify\/([a-zA-Z0-9]{40})$#' => [
        'controller' => AuthenticationController::class,
        'action' => 'verifyUser',
    ],

    '#^recover$#' => [
        'controller' => RecoveryController::class,
        'action' => 'index',
    ],

    '#^recover\/([a-zA-Z0-9]{40})$#' => [
        'controller' => RecoveryController::class,
        'action' => 'verifyRecovery',
    ],

    '#^logout$#' => [
        'controller' => SessionController::class,
        'action' => 'forgetCurrenUser',
    ],
];