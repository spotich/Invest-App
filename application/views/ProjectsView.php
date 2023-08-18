<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;
use InvestApp\application\models\Project;

class ProjectsView extends View
{
    private array  $projects;
    private string $pathToProjectsTemplate;

    public function __construct(?array $projects)
    {
        $this->projects = $projects;
        $this->pathToProjectsTemplate = dirname(__DIR__, 1) . "/views/templates/projects.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToProjectsTemplate, [
            'projects' => $this->projects,
        ]);
    }
}