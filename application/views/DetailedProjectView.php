<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;
use InvestApp\application\models\Project;

class DetailedProjectView extends View
{
    private string $pathToDetailedTemplate;
    private ?Project $project;

    public function __construct(?Project $project)
    {
        $this->project = $project;
        $this->pathToDetailedTemplate = dirname(__DIR__, 1) . "/views/templates/detailed.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToDetailedTemplate, [
            'project' => $this->project,
        ]);
    }
}