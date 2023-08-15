<?php

namespace application\databases;

use application\contracts\ProjectRepository;
class ProjectRepositoryMySQL extends DatabaseMySQL implements ProjectRepository
{
    public function getAllProjects(): ?array
    {
        $result = $this->getRow('SELECT p.*, pc.name as cover FROM projects p JOIN project_covers pc ON p.id = pc.project_id ORDER BY p.created_at DESC');
        return is_array($result) ? $result : null;
    }


    public function getProjectById(int $id): ?array
    {
        $params = ['id' => $id];
        $result = $this->getRow('SELECT p.*, pc.name as cover FROM projects p JOIN project_covers pc ON p.id = pc.project_id WHERE p.id = :id', $params);
        if (is_array($result)) {
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