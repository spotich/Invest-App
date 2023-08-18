<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\DetailedProjectView;
use InvestApp\application\views\ProjectsView;
use InvestApp\application\models\Project;
use InvestApp\application\core\View;
use InvestApp\application\models\User;
use InvestApp\application\views\MenuView;
use InvestApp\application\views\PageView;

class ProjectController
{
    private ?User $user = null;
    private ?Project $project = null;
    private ?array $projects = null;
    private MenuView $menuView;
    private ProjectsView $projectView;
    private DetailedProjectView $detailedProjectView;
    private PageView $pageView;

    public function __construct()
    {
        $this->user = SessionController::getCurrentUser();
        $this->menuView = new MenuView($this->user);
        $this->pageView = new PageView();
    }

    public function showProjects(): void
    {
        $this->projects = Project::getAllProjects();
        if (is_null($this->projects)) {
            return;
        }
        foreach ($this->projects as $project) {
            uasort($project->tags, function ($a, $b) {
                if (strlen($a) === strlen($b)) {
                    return 0;
                }
                return (strlen($a) < strlen($b)) ? -1 : 1;
            });
        }
        $this->projectView = new ProjectsView($this->projects);
        $this->pageView->renderPage('Projects', $this->menuView->getMenu(), $this->projectView->getContent());
    }

    public function showDetailedProject($id): void
    {
        $this->project = Project::findById($id);
        if (is_null($this->project)) {
            $this->pageView->renderErrorPage(404);
            return;
        } else {
            uasort($this->project->tags, function ($a, $b) {
                if (strlen($a) === strlen($b)) {
                    return 0;
                }
                return (strlen($a) < strlen($b)) ? -1 : 1;
            });
            $this->project->progressBar = $this->calculateProgress($this->project->progress, $this->project->goal);
            $this->detailedProjectView = new DetailedProjectView($this->project);
            $this->pageView->renderPage($this->project->name, $this->menuView->getMenu(), $this->detailedProjectView->getContent());
        }
    }

    private function calculateProgress($progress, $goal)
    {
        $result = $progress / $goal * 100;
        return round($result, 0, PHP_ROUND_HALF_DOWN);
    }
}