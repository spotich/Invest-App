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
        $params = ['id' => $id];
        $result = $this->getRow('SELECT p.*, group_concat(t.name) as tags FROM projects p JOIN projects_tags pt ON p.id = pt.project_id JOIN tags t ON pt.tag_id = t.id  WHERE p.id = :id GROUP BY p.id', $params);
        if (isset($result[0])) {
            $result[0]['team_members'] = $this->getRow('SELECT u.name, u.surname, ua.name as avatar, tm.role, tm.description FROM users u JOIN team_members tm ON u.id = tm.user_id JOIN user_avatars ua ON u.id = ua.user_id WHERE tm.project_id = :id', $params);
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