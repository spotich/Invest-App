<?php

namespace InvestApp\application\contracts;

interface ProjectRepository extends Database
{
    public function getAllProjects(): array|null;
    public function getProjectById(int $id): array|null;
    public function addTag(string $tag);
    public function removeTag(string $tag);
}