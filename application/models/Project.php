<?php

namespace InvestApp\application\models;

use InvestApp\application\contracts\ProjectRepository;

class Project
{
    public int $id;
    public string $name;
    public string $descriptionShort;
    public string $descriptionLong;
    public int $progress;
    public int $goal;
    public string $creationDate;
    public string $status;
    public string $cover;
    public array $teamMembers;
    public array $tags;
    private static ProjectRepository $projectRepo;

    public static function init(ProjectRepository $projectRepo)
    {
        self::$projectRepo = $projectRepo;
    }

    public static function getAllProjects(): ?array
    {
        $projectsData = self::$projectRepo->getAllProjects();
        if (is_null($projectsData)) {
            return null;
        }
        $projects = [];
        foreach ($projectsData as $project) {
            $projects[] = self::deserializeFromArray($project);
        }
        return $projects;
    }

    public static function findById(int $id): ?Project
    {
        $projectArray = self::$projectRepo->getProjectById($id);
        return is_null($projectArray) ? null : self::deserializeFromArray($projectArray);
    }

    public static function deserializeFromArray(array $data): Project
    {
        $project = new Project();
        if (isset($data['id']) and is_int($data['id'])) $project->id = $data['id'];
        if (isset($data['name']) and is_string($data['name'])) $project->name = $data['name'];
        if (isset($data['description_short']) and is_string($data['description_short'])) $project->descriptionShort = $data['description_short'];
        if (isset($data['description_long']) and is_string($data['description_long'])) $project->descriptionLong = $data['description_long'];
        if (isset($data['progress']) and is_int($data['progress'])) $project->progress = $data['progress'];
        if (isset($data['goal']) and is_int($data['goal'])) $project->goal = $data['goal'];
        if (isset($data['created_at']) and is_string($data['created_at'])) $project->creationDate = $data['created_at'];
        if (isset($data['status']) and is_string($data['status'])) $project->status = $data['status'];
        if (isset($data['cover']) and is_string($data['cover'])) $project->cover = $data['cover'];
        if (isset($data['team_members']) and is_array($data['team_members'])) $project->teamMembers = $data['team_members'];
        if (isset($data['tags']) and is_string($data['tags'])) $project->tags = explode(',', $data['tags']);
        return $project;
    }

    public function serializeToArray(): array
    {
        $result = [];
        if (isset($this->id)) $result['id'] = $this->id;
        if (isset($this->name)) $result['name'] = $this->name;
        if (isset($this->descriptionShort)) $result['description_short'] = $this->descriptionShort;
        if (isset($this->descriptionLong)) $result['description_long'] = $this->descriptionLong;
        if (isset($this->progress)) $result['progress'] = $this->progress;
        if (isset($this->goal)) $result['goal'] = $this->goal;
        if (isset($this->creationDate)) $result['created_at'] = $this->creationDate;
        if (isset($this->status)) $result['status'] = $this->status;
        if (isset($this->cover)) $result['cover'] = $this->cover;
        if (isset($this->teamMembers)) $result['team_members'] = $this->teamMembers;
        return $result;
    }
}