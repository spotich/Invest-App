<?php

namespace InvestApp\application\views\pages;

use InvestApp\application\core\View;

class HomePageView extends View
{
    private string $pathToHomeTemplate;

    public function __construct()
    {
        $this->pathToHomeTemplate = dirname(__DIR__, 1) . "/templates/home.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToHomeTemplate);
    }
}