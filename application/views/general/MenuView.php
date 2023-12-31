<?php

namespace InvestApp\application\views\general;

use InvestApp\application\core\View;
use InvestApp\application\models\User;

class MenuView extends View
{
    private ?User $user;
    private string $pathToDefaultMenuTemplate;
    private string $pathToAdminNavigation;
    private string $pathToBaseNavigation;
    private string $pathToTeamMemberNavigation;
    private string $pathToButtonsTemplate;
    private string $pathToMiniatureTemplate;

    public function __construct(?User $user = null)
    {
        $this->user = $user;
        $this->pathToDefaultMenuTemplate = dirname(__DIR__, 1) . "/menus/default.php";
        $this->pathToButtonsTemplate = dirname(__DIR__, 1) . "/menus/buttons.php";
        $this->pathToMiniatureTemplate = dirname(__DIR__, 1) . "/menus/miniature.php";
        $this->pathToAdminNavigation = dirname(__DIR__, 1) . "/../config/menu/admin.php";
        $this->pathToBaseNavigation = dirname(__DIR__, 1) . "/../config/menu/base.php";
        $this->pathToTeamMemberNavigation = dirname(__DIR__, 1) . "/../config/menu/teamMember.php";
    }

    public function getMenu(): string
    {
        return $this->renderTemplate($this->pathToDefaultMenuTemplate, [
            'navItems' => $this->getNavItems(),
            'buttons' => $this->getButtons(),
            'miniature' => $this->getMiniature(),
        ]);
    }

    private function getNavItems(): array
    {
        $baseNavigation = require $this->pathToBaseNavigation;
        if ($this->parametersAreValid()) {
            $advancedNavigation = match ($this->user->role) {
                'Admin' => require $this->pathToAdminNavigation,
                'Team member' => require $this->pathToTeamMemberNavigation,
            };
            return array_merge($baseNavigation, $advancedNavigation);
        } else {
            return $baseNavigation;
        }
    }

    private function getButtons(): string {
        if ($this->parametersAreValid()) {
            return '';
        } else {
            return $this->renderTemplate($this->pathToButtonsTemplate);
        }
    }

    private function getMiniature(): string {
        if ($this->parametersAreValid()) {
            return $this->renderTemplate($this->pathToMiniatureTemplate, ['user' => $this->user]);
        } else {
            return '';
        }
    }

    private function parametersAreValid(): ?bool
    {
        return (isset($this->user->name) and is_string($this->user->name) and isset($this->user->surname) and is_string($this->user->surname) and isset($this->user->role) and is_string($this->user->role) and isset($this->user->avatar) and is_string($this->user->avatar));
    }
}