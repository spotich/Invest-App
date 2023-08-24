<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;
use InvestApp\application\models\Project;

class DetailedRequestPageView extends View
{
    private string $pathToDetailedTemplate;
    private ?Project $request;

    public function __construct(?Project $request)
    {
        $this->request = $request;
        $this->pathToDetailedTemplate = dirname(__DIR__, 1) . "/views/templates/detailedRequest.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToDetailedTemplate, [
            'request' => $this->request,
        ]);
    }
}