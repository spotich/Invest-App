<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;

class RegistrationPageView extends View
{
    private string $pathToRegisterTemplate;

    public function __construct()
    {
        $this->pathToRegisterTemplate = dirname(__DIR__, 1) . "/views/templates/register.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToRegisterTemplate, [
            'message' => $this->message,
        ]);
    }
}