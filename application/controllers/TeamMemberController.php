<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\general\MenuView;
use InvestApp\application\views\general\PageView;
use InvestApp\application\views\pages\CreateRequestPageView;
use InvestApp\application\views\pages\DetailedRequestTeamMemberPageView;
use InvestApp\application\views\pages\RequestsTeamMemberPageView;
use InvestApp\application\models\Project;
use InvestApp\application\models\User;
use InvestApp\application\traits\SortingStringsTrait;

class TeamMemberController
{
    use SortingStringsTrait;

    private ?User $user = null;
    private ?Project $request = null;
    private ?array $requests = null;
    private MenuView $menuView;
    private RequestsTeamMemberPageView $teamMemberView;
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
        $this->teamMemberView = new RequestsTeamMemberPageView($declinedRequests, $pendingRequests, $activeRequests);
        $this->pageView->renderPage('My Requests', $this->menuView->getMenu(), $this->teamMemberView->getContent());
        exit;
    }

    public function showRequestDetails(int $id): void
    {
        if (is_null($request = Project::getDetailedProjectById($id))) {
            $this->pageView->renderErrorPage(404);
            return;
        }
        $request->tags = $this->sortStrings($request->tags);
        $detailedRequestView = new DetailedRequestTeamMemberPageView($request);
        $this->pageView->renderPage($request->name, $this->menuView->getMenu(), $detailedRequestView->getContent());
        exit;
    }

    public function showCreatePage(): void
    {
        $createPageView = new CreateRequestPageView(Project::getAllTags(), User::getAllTeamMembers(), $this->user->id);
        $this->pageView->renderPage('Create', $this->menuView->getMenu(), $createPageView->getContent());
        exit;
    }

    public function createRequest(): void
    {
        Project::toObject($_POST)->save();
        $this->pageView->redirectToUrl('/my-requests');
        exit;
    }
}