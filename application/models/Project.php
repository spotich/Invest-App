<?php

namespace application\models;
use application\contracts\ProjectRepository;

class Project
{
    private static ProjectRepository $projectRepo;

    public static function init(ProjectRepository $projectRepo)
    {
        self::$projectRepo = $projectRepo;
    }
}