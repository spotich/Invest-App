<?php

namespace InvestApp\application\models;

use InvestApp\application\contracts\ProjectRepository;
use InvestApp\application\models\Model;

class Project extends Model
{
    public int $id;
    public string $name;
    public string $description_short;
    public string $description_long;
    public int $progress;
    public int $goal;
    public string $created_at;
    public string $status;
    public string $message;
    public string $cover;
    public array $team_members;
    public array $tags;
    public array $slides;
    private static ProjectRepository $projectRepo;

    public static function init(ProjectRepository $projectRepo): void
    {
        self::$projectRepo = $projectRepo;
    }

    public static function getAllProjects(string $status): ?array
    {
        $projectsData = self::$projectRepo->getAllProjects($status);
        if (is_null($projectsData)) {
            return null;
        }
        $projects = [];
        foreach ($projectsData as $project) {
            $projects[] = self::toObject($project);
        }
        return $projects;
    }

    public static function getAllProjectsOfAuthor(string $status, int $author_id): ?array
    {
        $projectsData = self::$projectRepo->getAllProjectsOfAuthor($status, $author_id);
        if (is_null($projectsData)) {
            return null;
        }
        $projects = [];
        foreach ($projectsData as $project) {
            $projects[] = self::toObject($project);
        }
        return $projects;
    }

    public static function getAllTags(): ?array
    {
        return self::$projectRepo->getAllTags();
    }

    public static function findById(int $id): ?Project
    {
        $projectArray = self::$projectRepo->getProjectById($id);
        return is_null($projectArray) ? null : self::toObject($projectArray);
    }

    public static function getDetailedProjectById(int $id): ?Project
    {
        $projectArray = self::$projectRepo->getProjectById($id);
        $projectArray['team_members'] = self::$projectRepo->getProjectMembers($id);
        $projectArray['slides'] = self::$projectRepo->getProjectSlides($id);
        $projectArray['tags'] = self::$projectRepo->getProjectTags($id);
        return is_null($projectArray) ? null : self::toObject($projectArray);

    }

    public function save(): void
    {
        if (isset($this->id)) {
            $result = self::$projectRepo->getProjectById($this->id);
            if (!is_null($result)) {
                self::$projectRepo->updateProject($this->toArray());
            }
        } else {
            $this->id = self::$projectRepo->createNewProject($this->toArray());
        }
    }
}