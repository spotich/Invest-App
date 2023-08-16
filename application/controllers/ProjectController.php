<?php

namespace InvestApp\application\controllers;

use InvestApp\application\models\Project;
use InvestApp\application\core\View;

class ProjectController
{
    public function showProjects()
    {
        $projects = Project::fetchAllData();
        $projects[0]['tags'] = ['nature', 'science', 'eco', 'transport', 'innovation'];
        $projects[1]['tags'] = ['society', 'medicine', 'finance', 'communication', 'charity'];
        $projects[2]['tags'] = ['IT', 'science', 'finance'];
        $vars = [
            'title' => 'Projects',
            'projects' => $projects,
        ];
        if (SessionController::isCurrentUserActive()) {
            $vars['menu'] = 'auth';
            $vars['user'] = SessionController::getCurrentUserData();
        } else {
            $vars['menu'] = 'anon';
        }
        View::render('projects', $vars);
    }

    public function showDetailedProject($id)
    {
        $pattern = '/^(\d+)$/';
        if (preg_match($pattern, $id, $matches)) {
            $id = $matches[1];
            $project = Project::findById($id);
            if (is_null($project)) {
                PageController::showError(404);
            } else {
                $projectToArray = $project->serializeToArray();
                $projectToArray['progressbar'] = $this->calculateProgress($project->progress, $project->goal);
                $vars = [
                    'title' => $project->name,
                    'project' => $projectToArray,
                ];
                if (SessionController::isCurrentUserActive()) {
                    $vars['menu'] = 'auth';
                    $vars['user'] = SessionController::getCurrentUserData();
                } else {
                    $vars['menu'] = 'anon';
                }
                View::render('detailed', $vars);
            }
        } else {
            PageController::showError(404);
        }
    }

    private function calculateProgress($progress, $goal)
    {
        $result = $progress / $goal * 100;
        return round($result, 0, PHP_ROUND_HALF_DOWN);
    }
}