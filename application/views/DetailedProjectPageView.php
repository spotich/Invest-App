<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;
use InvestApp\application\models\Project;

class DetailedProjectPageView extends View
{
    private string $pathToDetailedTemplate;
    private ?Project $project;

    public function __construct(?Project $project)
    {
        $this->project = $project;
        $this->pathToDetailedTemplate = dirname(__DIR__, 1) . "/views/templates/detailedProject.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToDetailedTemplate, [
            'project' => $this->project,
        ]);
    }
}