<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;

class ConfirmationView extends View
{
    private string $pathToConfirmEmailTemplate;

    public function __construct()
    {
        $this->pathToConfirmTemplate = dirname(__DIR__, 1) . "/views/templates/confirmEmail.php";
    }

    public function getContent(string $pageTitle, string $receiverEmail, string $instruction): ?string
    {
        return $this->renderTemplate($this->pathToConfirmTemplate, [
            'pageTitle' => $pageTitle,
            'receiverEmail' => $receiverEmail,
            'instruction' => $instruction,
        ]);
    }
}