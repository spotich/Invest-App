<?php

namespace application\contracts;

interface ProjectRepository extends Database
{
    public function getAllProjects(): array|null;
    public function getProjectData(int $id): array|null;
    public function addTag(string $tag);
    public function removeTag(string $tag);
}