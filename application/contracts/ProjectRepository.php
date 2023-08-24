<?php

namespace InvestApp\application\contracts;

interface ProjectRepository extends Repository
{
    public function getAllProjects(string $status): ?array;
    public function getAllProjectsOfAuthor(string $status, int $author_id): ?array;
    public function getAllTags(): ?array;
    public function getProjectById(int $id): ?array;
    public function addTag(int $id): void;
    public function removeTag(int $id): void;
    public function addMember(int $id): void;
    public function removeMember(int $id): void;
    public function addSlide(int $id): void;
    public function removeSlide(int $id): void;
    public function updateProject(array $project);
    public function createNewProject(array $project);
}