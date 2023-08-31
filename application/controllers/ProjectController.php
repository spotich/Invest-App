<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\general\MenuView;
use InvestApp\application\views\general\PageView;
use InvestApp\application\views\pages\DetailedProjectPageView;
use InvestApp\application\views\pages\ProjectsPageView;
use InvestApp\application\models\Project;
use InvestApp\application\models\User;
use InvestApp\application\traits\SortingStringsTrait;

class ProjectController
{
    use SortingStringsTrait;

    private ?User $user = null;
    private ?Project $project = null;
    private ?array $projects = null;
    private MenuView $menuView;
    private ProjectsPageView $projectView;
    private DetailedProjectPageView $detailedProjectView;
    private PageView $pageView;

    public function __construct()
    {
        $this->user = SessionController::getCurrentUser();
        $this->menuView = new MenuView($this->user);
        $this->pageView = new PageView();
    }

    public function showAllProjects(): void
    {
        $this->projects = Project::getAllProjects('active');
        if (is_null($this->projects)) {
            return;
        }
        foreach ($this->projects as $project) {
            $project->tags = $this->sortStrings($project->tags);
        }
        $this->projectView = new ProjectsPageView($this->projects);
        $this->pageView->renderPage('Projects', $this->menuView->getMenu(), $this->projectView->getContent());
    }

    public function showDetailedProject($id): void
    {
        $this->project = Project::getDetailedProjectById($id);
        if (is_null($this->project)) {
            $this->pageView->renderErrorPage(404);
            return;
        }
        $this->project->tags = $this->sortStrings($this->project->tags);
        $this->project->progress_bar = $this->calculateProgress($this->project->progress, $this->project->goal);
        $this->detailedProjectView = new DetailedProjectPageView($this->project);
        $this->pageView->renderPage($this->project->name, $this->menuView->getMenu(), $this->detailedProjectView->getContent());
    }

    private function calculateProgress($progress, $goal): float
    {
        $result = $progress / $goal * 100;
        return round($result, 0, PHP_ROUND_HALF_DOWN);
    }
}