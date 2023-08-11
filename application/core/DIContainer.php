<?php

namespace application\core;

use application\contracts\UserRepository;
use application\contracts\ProjectRepository;
use application\controllers\AuthenticationController;
use application\controllers\ProfileController;
use application\controllers\ProjectController;
use application\controllers\RecoveryController;
use application\databases\ProjectRepositoryMySQL;
use application\databases\UserRepositoryMySQL;
use application\models\User;
use application\models\Project;

class DIContainer
{
    private array $dependencies = [];

    public function __construct()
    {
        $this->dependencies = [
            UserRepository::class => fn() => new UserRepositoryMySQL(),
            ProjectRepository::class => fn() => new ProjectRepositoryMySQL(),

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