<?php

namespace application\models;

use application\contracts\ProjectRepository;

class Project
{
    public int $id;
    public string $name;
    public string $description_short;
    public string $description_long;
    public int $progress;
    public int $goal;
    public string $created_at;
    public string $status;
    public string $cover;
    public array $team_members;
    private static ProjectRepository $projectRepo;

    public static function init(ProjectRepository $projectRepo)
    {
        self::$projectRepo = $projectRepo;
    }

    public static function fetchAllData(): ?array
    {
        return self::$projectRepo->getAllProjects();
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
        if (isset($data['description_short']) and is_string($data['description_short'])) $project->description_short = $data['description_short'];
        if (isset($data['description_long']) and is_string($data['description_long'])) $project->description_long = $data['description_long'];
        if (isset($data['progress']) and is_int($data['progress'])) $project->progress = $data['progress'];
        if (isset($data['goal']) and is_int($data['goal'])) $project->goal = $data['goal'];
        if (isset($data['created_at']) and is_string($data['created_at'])) $project->created_at = $data['created_at'];
        if (isset($data['status']) and is_string($data['status'])) $project->status = $data['status'];
        if (isset($data['cover']) and is_string($data['cover'])) $project->cover = $data['cover'];
        if (isset($data['team_members']) and is_array($data['team_members'])) $project->team_members = $data['team_members'];
        return $project;
    }

    public function serializeToArray(): array
    {
        $result = [];
        if (isset($this->id)) $result['id'] = $this->id;
        if (isset($this->name)) $result['name'] = $this->name;
        if (isset($this->description_short)) $result['description_short'] = $this->description_short;
        if (isset($this->description_long)) $result['description_long'] = $this->description_long;
        if (isset($this->progress)) $result['progress'] = $this->progress;
        if (isset($this->goal)) $result['goal'] = $this->goal;
        if (isset($this->created_at)) $result['created_at'] = $this->created_at;
        if (isset($this->status)) $result['status'] = $this->status;
        if (isset($this->cover)) $result['cover'] = $this->cover;
        if (isset($this->team_members)) $result['team_members'] = $this->team_members;
        return $result;
    }
}