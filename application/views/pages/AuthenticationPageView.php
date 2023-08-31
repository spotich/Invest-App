<?php

namespace InvestApp\application\views\pages;

use InvestApp\application\core\View;

class AuthenticationPageView extends View
{
    private string $pathToLoginTemplate;

    public function __construct()
    {
        $this->pathToLoginTemplate = dirname(__DIR__, 1) . "/templates/login.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToLoginTemplate, [
            'message' => $this->message,
        ]);
    }
}