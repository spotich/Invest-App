<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;

class AuthenticationView extends View
{
    private string $pathToLoginTemplate;

    public function __construct()
    {
        $this->pathToLoginTemplate = dirname(__DIR__, 1) . "/views/templates/login.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToLoginTemplate, [
            'message' => $this->message,
        ]);
    }
}