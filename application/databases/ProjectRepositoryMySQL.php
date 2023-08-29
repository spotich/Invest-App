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
        $results = $this->getRow('SELECT id, name, description_short, created_at, cover, message FROM projects WHERE status = :status AND author = :author ORDER BY created_at DESC', ['status' => $status, 'author' => $author_id]);
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
        return $this->getRow('SELECT cover, title, description FROM project_carousel WHERE project_id = :project_id ORDER BY `order`', ['project_id' => $id]);
    }

    public function getProjectTags(int $id): array
    {
        return $this->getColumn('SELECT t.name FROM projects p JOIN projects_tags pt ON p.id = pt.project_id JOIN tags t ON pt.tag_id = t.id where p.id = :id', ['id' => $id]);
    }


    public function createNewProject(array $project): int
    {
        $this->executeQuery('INSERT INTO projects (name, goal, description_short, description_long, cover, author) VALUES (:name, :goal, :description_short, :description_long, :cover, :author)', [
            'name' => $project['name'],
            'goal' => $project['goal'],
            'description_short' => $project['description_short'],
            'description_long' => $project['description_long'],
            'cover' => $project['cover'],
            'author' => $project['author'],
        ]);
        $project_id = $this->getLastInsertId();
        foreach ($project['team_members'] as $member_id => $member) {
            $this->addMember($member_id, $member['role'], $member['description'], $project_id);
        }
        foreach ($project['slides'] as $order => $slide) {
            $this->addSlide($project_id, $slide['cover'], $slide['title'], $slide['description'], $order);
        }
        foreach ($project['tags'] as $tag_id) {
            $this->addTag($project_id, $tag_id);
        }
        return $project_id;
    }

    public function addTag(int $project_id, int $tag_id): void
    {
        $this->executeQuery('INSERT INTO projects_tags (project_id, tag_id) VALUES (:project_id, :tag_id)', [
            'project_id' => $project_id,
            'tag_id' => $tag_id,
        ]);
    }

    public function addMember(int $user_id, string $role, string $description, int $project_id): void
    {
        $this->executeQuery('INSERT INTO team_members (user_id, role, description, project_id) VALUES (:user_id, :role, :description, :project_id)', [
            'user_id' => $user_id,
            'role' => $role,
            'description' => $description,
            'project_id' => $project_id,
        ]);
    }

    public function addSlide(int $project_id, string $cover, string $title, string $description, int $order): void
    {
        $this->executeQuery('INSERT INTO project_carousel (project_id, cover, title, description, `order`) VALUES (:project_id, :cover, :title, :description, :order)', [
            'project_id' => $project_id,
            'cover' => $cover,
            'title' => $title,
            'description' => $description,
            'order' => $order,
        ]);
    }
}