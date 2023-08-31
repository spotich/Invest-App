<?php

namespace InvestApp\application\views\pages;

use InvestApp\application\core\View;

class RecoveryPageView extends View
{
    private string $pathToRecoverTemplate;
    private string $pathToNewPasswordTemplate;

    public function __construct()
    {
        $this->pathToRecoverTemplate = dirname(__DIR__, 1) . "/templates/recover.php";
        $this->pathToNewPasswordTemplate = dirname(__DIR__, 1) . "/templates/newPassword.php";
    }

    public function getRecoveryPageContent(): ?string
    {
        return $this->renderTemplate($this->pathToRecoverTemplate, [
            'message' => $this->message,
        ]);
    }

    public function getNewPasswordPageContent(): ?string
    {
        return $this->renderTemplate($this->pathToNewPasswordTemplate, [
            'message' => $this->message,
        ]);
    }
}