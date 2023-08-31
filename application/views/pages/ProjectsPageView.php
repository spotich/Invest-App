<?php

namespace InvestApp\application\views\pages;

use InvestApp\application\core\View;

class ProjectsPageView extends View
{
    private array  $projects;
    private string $pathToProjectsTemplate;

    public function __construct(?array $projects)
    {
        $this->projects = $projects;
        $this->pathToProjectsTemplate = dirname(__DIR__, 1) . "/templates/projects.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToProjectsTemplate, [
            'projects' => $this->projects,
        ]);
    }
}