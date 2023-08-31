<?php

namespace InvestApp\application\views\pages;

use InvestApp\application\core\View;

class ConfirmationPageView extends View
{
    private string $pathToConfirmEmailTemplate;

    public function __construct()
    {
        $this->pathToConfirmTemplate = dirname(__DIR__, 1) . "/templates/confirmEmail.php";
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