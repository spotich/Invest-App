<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;

class HomePageView extends View
{
    private string $pathToHomeTemplate;

    public function __construct()
    {
        $this->pathToHomeTemplate = dirname(__DIR__, 1) . "/views/templates/home.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToHomeTemplate);
    }
}