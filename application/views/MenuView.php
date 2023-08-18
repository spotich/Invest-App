<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;
use InvestApp\application\models\User;

class MenuView extends View
{
    private ?User $user;
    private string $pathToAnonMenuTemplate;
    private string $pathToAuthMenuTemplate;
    private string $pathToAdminNavigation;
    private string $pathToUsualNavigation;

    public function __construct(?User $user)
    {
        $this->user = $user;
        $this->pathToAnonMenuTemplate = dirname(__DIR__, 1) . "/views/menus/anon.php";
        $this->pathToAuthMenuTemplate = dirname(__DIR__, 1) . "/views/menus/auth.php";
        $this->pathToAdminNavigation = dirname(__DIR__, 1) . "/views/menus/adminNavigation.php";
        $this->pathToUsualNavigation = dirname(__DIR__, 1) . "/views/menus/usualNavigation.php";
    }

    public function getMenu(): string
    {
        if ($this->parametersAreValid()) {
            return $this->renderTemplate($this->pathToAuthMenuTemplate, [
                'user' => $this->user,
                'navigation' => $this->getNavigation(),
            ]);
        } else {
            return $this->renderTemplate($this->pathToAnonMenuTemplate, [
                'navigation' => $this->renderTemplate($this->pathToUsualNavigation),
            ]);
        }
    }

    private function getNavigation(): ?string
    {
        if ($this->user->role === 'Admin') {
            return $this->renderTemplate($this->pathToAdminNavigation);
        } else {
            return $this->renderTemplate($this->pathToUsualNavigation);
        }
    }

    private function parametersAreValid(): ?bool
    {
        return (isset($this->user->name) and is_string($this->user->name) and isset($this->user->surname) and is_string($this->user->surname) and isset($this->user->role) and is_string($this->user->role) and isset($this->user->avatar) and is_string($this->user->avatar));
    }
}