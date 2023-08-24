<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\CreateRequestPageView;
use InvestApp\application\models\Project;
use InvestApp\application\models\User;
use InvestApp\application\traits\SortingStringsTrait;
use InvestApp\application\views\DetailedRequestPageView;
use InvestApp\application\views\MenuView;
use InvestApp\application\views\PageView;
use InvestApp\application\views\RequestsTeamMemberView;

class TeamMemberController
{
    use SortingStringsTrait;

    private ?User $user = null;
    private ?Project $request = null;
    private ?array $requests = null;
    private MenuView $menuView;
    private DetailedRequestPageView $detailedRequestView;
    private RequestsTeamMemberView $teamMemberView;
    private PageView $pageView;

    public function __construct()
    {
        $this->user = SessionController::getCurrentUser();
        $this->menuView = new MenuView($this->user);
        $this->pageView = new PageView();
        if ($this->user->role !== 'Team member') {
            $this->pageView->renderErrorPage(404);
        }
    }

    public function showMyRequests(): void
    {
        $declinedRequests = Project::getAllProjectsOfAuthor('declined', $this->user->id);
        $pendingRequests = Project::getAllProjectsOfAuthor('pending', $this->user->id);
        $activeRequests = Project::getAllProjectsOfAuthor('active', $this->user->id);
        if (is_null($declinedRequests) or is_null($pendingRequests) or is_null($activeRequests)) {
            $this->pageView->renderErrorPage(404);
        }
        foreach ($declinedRequests as $request) {
            $request->tags = $this->sortStrings($request->tags);
        }
        foreach ($pendingRequests as $request) {
            $request->tags = $this->sortStrings($request->tags);
        }
        foreach ($activeRequests as $request) {
            $request->tags = $this->sortStrings($request->tags);
        }
        $this->teamMemberView = new RequestsTeamMemberView($declinedRequests, $pendingRequests, $activeRequests);
        $this->pageView->renderPage('My Requests', $this->menuView->getMenu(), $this->teamMemberView->getContent());
    }

    public function showCreatePage(): void
    {
        $availableTags = Project::getAllTags();
        $createPageView = new CreateRequestPageView($availableTags);
        $this->pageView->renderPage('Create', $this->menuView->getMenu(), $createPageView->getContent());
    }

    public function test(): void
    {
        echo '<pre>';
        var_dump($_POST);
        echo '<pre>';
        exit;
    }
}