<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;
use InvestApp\application\models\User;

class ProfilePageView extends View
{
    private string $pathToProfileTemplate;
    private ?User $user;

    public function __construct(?User $user)
    {
        $this->user = $user;
        $this->pathToProfileTemplate = dirname(__DIR__, 1) . "/views/templates/profile.php";
    }

    public function getContent(): ?string
    {
        if (isset($this->user->name) and isset($this->user->surname) and isset($this->user->email) and isset($this->user->avatar)) {
            return $this->renderTemplate($this->pathToProfileTemplate, [
                'message' => $this->message,
                'user' => $this->user,
            ]);
        } else {
            return null;
        }
    }
}