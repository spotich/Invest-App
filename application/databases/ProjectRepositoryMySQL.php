<?php

namespace InvestApp\application\databases;

use InvestApp\application\contracts\ProjectRepository;

class ProjectRepositoryMySQL extends RepositoryMySQL implements ProjectRepository
{
    public function getAllProjects(string $status): ?array
    {
        $results = $this->getRow('SELECT id, name, description_short, created_at, cover FROM projects WHERE status = :status', ['status' => $status]);
        for ($i = 0; $i < sizeof($results); $i++) {
            $results[$i]['tags'] = $this->getColumn('SELECT t.name FROM projects p JOIN projects_tags pt ON p.id = pt.project_id JOIN tags t ON pt.tag_id = t.id where p.id = :id', ['id' => $results[$i]['id']]);
        }
        return is_array($results) ? $results : null;
    }

    public function getAllProjectsOfAuthor(string $status, int $author_id): ?array
    {
        $results = $this->getRow('SELECT id, name, description_short, created_at, cover, message FROM projects WHERE status = :status AND author = :author', ['status' => $status, 'author' => $author_id]);
        for ($i = 0; $i < sizeof($results); $i++) {
            $results[$i]['tags'] = $this->getColumn('SELECT t.name FROM projects p JOIN projects_tags pt ON p.id = pt.project_id JOIN tags t ON pt.tag_id = t.id where p.id = :id', ['id' => $results[$i]['id']]);
        }
        return is_array($results) ? $results : null;
    }

    public function getAllTags(): ?array
    {
        if ($tags = $this->getRow('SELECT * FROM tags')) {
            return $tags;
        } else {
            return null;
        }
    }

    public function getProjectById(int $id): ?array
    {
        $result = $this->getRow('SELECT * FROM projects WHERE id = :id', ['id' => $id]);
        return is_array($result[0]) ? $result[0] : null;
    }

    public function updateProject(array $project)
    {
        if (!isset($project['id'])) {
            return null;
        }
        $setting = $this->getUpdateSetting($project);
        return $this->executeQuery("UPDATE projects SET $setting WHERE id = :id", $project);
    }

    public function getProjectMembers(int $id): array
    {
        return $this->getRow('SELECT u.name, u.surname, u.avatar, tm.user_id, tm.role, tm.description FROM users u JOIN team_members tm ON u.id = tm.user_id WHERE tm.project_id = :id', ['id' => $id]);
    }

    public function getProjectSlides(int $id): array
    {
        return $this->getRow('SELECT cover, title, description FROM project_carousel WHERE project_id = :project_id', ['project_id' => $id]);
    }

    public function getProjectTags(int $id): array
    {
        return $this->getColumn('SELECT t.name FROM projects p JOIN projects_tags pt ON p.id = pt.project_id JOIN tags t ON pt.tag_id = t.id where p.id = :id', ['id' => $id]);
    }


    public function createNewProject(array $project)
    {

    }

    public function addTag(int $id): void
    {

    }

    public function removeTag(int $id): void
    {

    }

    public function addMember(int $id): void
    {

    }

    public function removeMember(int $id): void
    {

    }

    public function addSlide(int $id): void
    {

    }

    public function removeSlide(int $id): void
    {

    }
}