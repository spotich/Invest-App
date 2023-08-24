<?php

namespace InvestApp\application\controllers;


use InvestApp\application\views\MenuView;
use InvestApp\application\views\HomePageView;
use InvestApp\application\views\PageView;
use InvestApp\application\models\User;

class HomeController
{
    private ?User $user;
    private MenuView $menuView;
    private HomePageView $homeView;
    private PageView $pageView;

    public function index(): void
    {
        $this->user = SessionController::getCurrentUser();
        $this->menuView = new MenuView($this->user);
        $this->homeView = new HomePageView();
        $this->pageView = new PageView();
        $this->pageView->renderPage('Home', $this->menuView->getMenu(), $this->homeView->getContent());
    }
}