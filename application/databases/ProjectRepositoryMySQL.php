<?php

namespace InvestApp\application\databases;

use InvestApp\application\contracts\ProjectRepository;

class ProjectRepositoryMySQL extends RepositoryMySQL implements ProjectRepository
{
    public function getAllProjects(): ?array
    {
        $result = $this->getRow('SELECT p.*, group_concat(t.name) as tags FROM projects p JOIN projects_tags pt ON p.id = pt.project_id JOIN tags t ON pt.tag_id = t.id GROUP BY p.id');
        return is_array($result) ? $result : null;
    }

    public function getProjectById(int $id): ?array
    {
        $result = $this->getRow('SELECT p.*, group_concat(t.name) as tags FROM projects p JOIN projects_tags pt ON p.id = pt.project_id JOIN tags t ON pt.tag_id = t.id  WHERE p.id = :id GROUP BY p.id', ['id' => $id]);
        if (isset($result[0])) {
            $result[0]['team_members'] = $this->getRow('SELECT u.name, u.surname, u.avatar, tm.role, tm.description FROM users u JOIN team_members tm ON u.id = tm.user_id WHERE tm.project_id = :id', ['id' => $id]);
            $result[0]['slides'] = $this->getRow('SELECT cover, title, description FROM project_carousel WHERE project_id = :project_id', ['project_id' => $id]);
        } else {
            return null;
        }
        return $result[0];
    }

    public function addTag(string $tag)
    {

    }

    public function removeTag(string $tag)
    {

    }
}