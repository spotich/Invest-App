<?php

namespace InvestApp\application\contracts;

interface ProjectRepository extends Repository
{
    public function getAllProjects(string $status): ?array;
    public function getAllProjectsOfAuthor(string $status, int $author_id): ?array;
    public function getAllTags(): ?array;
    public function getProjectById(int $id): ?array;
    public function addTag(int $project_id, int $tag_id): void;
    public function addMember(int $user_id, string $role, string $description, int $project_id): void;
    public function addSlide(int $project_id, string $cover, string $title, string $description, int $order): void;
    public function updateProject(array $project);
    public function createNewProject(array $project): int;
}