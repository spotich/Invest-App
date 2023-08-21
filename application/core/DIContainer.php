<?php

namespace InvestApp\application\core;

use InvestApp\application\contracts\UserRepository;
use InvestApp\application\contracts\ProjectRepository;
use InvestApp\application\controllers\AuthenticationController;
use InvestApp\application\controllers\HomeController;
use InvestApp\application\controllers\ProfileController;
use InvestApp\application\controllers\ProjectController;
use InvestApp\application\controllers\RecoveryController;
use InvestApp\application\controllers\RegistrationController;
use InvestApp\application\controllers\SessionController;
use InvestApp\application\databases\ProjectRepositoryMySQL;
use InvestApp\application\databases\UserRepositoryMySQL;
use InvestApp\application\models\User;
use InvestApp\application\models\Project;

class DIContainer
{
    private array $dependencies = [];

    public function __construct()
    {
        $this->dependencies = [
            UserRepository::class => fn() => new UserRepositoryMySQL(),
            ProjectRepository::class => fn() => new ProjectRepositoryMySQL(),

            HomeController::class => fn() => new HomeController(),
            SessionController::class => fn() => new SessionController(),
            RegistrationController::class =>function () {
                User::init($this->get(UserRepository::class));
                return new RegistrationController();
            },
            AuthenticationController::class => function () {
                User::init($this->get(UserRepository::class));
                return new AuthenticationController();
            },
            ProfileController::class => function () {
                User::init($this->get(UserRepository::class));
                return new ProfileController();
            },
            RecoveryController::class => function () {
                User::init($this->get(UserRepository::class));
                return new RecoveryController();
            },
            ProjectController::class => function () {
                Project::init($this->get(ProjectRepository::class));
                return new ProjectController();
            },
        ];
    }

    public function has(string $className): bool
    {
        return isset($this->dependencies[$className]);
    }

    public function get(string $className)
    {
        return $this->dependencies[$className]();
    }
}