<?php

namespace application\databases;

use application\contracts\ProjectRepository;

class ProjectRepositoryMySQL extends DatabaseMySQL implements ProjectRepository
{
    public function getAllProjects(): array|null
    {
        return [];
    }

    public function getProjectData(int $id): array|null
    {
        return [];
    }

    public function addTag(string $tag)
    {

    }

    public function removeTag(string $tag)
    {

    }
}