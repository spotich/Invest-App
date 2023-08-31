<?php

namespace InvestApp\application\controllers;

use InvestApp\application\views\general\MenuView;
use InvestApp\application\views\general\PageView;
use InvestApp\application\views\pages\DetailedRequestPageView;
use InvestApp\application\views\pages\RequestsPageView;
use InvestApp\application\contracts\ProjectRepository;
use InvestApp\application\models\Project;
use InvestApp\application\models\User;
use InvestApp\application\traits\SortingStringsTrait;


class AdminController
{
    use SortingStringsTrait;

    private ?User $user = null;
    private ?Project $request = null;
    private ?array $requests = null;
    private MenuView $menuView;
    private DetailedRequestPageView $detailedRequestView;
    private RequestsPageView $adminView;
    private PageView $pageView;

    private static ProjectRepository $projectRepo;

    public function __construct()
    {
        $this->user = SessionController::getCurrentUser();
        $this->menuView = new MenuView($this->user);
        $this->pageView = new PageView();
        if ($this->user->role !== 'Admin') {
            $this->pageView->renderErrorPage(404);
        }
    }

    public function showAllRequests(): void
    {
        $this->requests = Project::getAllProjects('pending');
        if (is_null($this->requests)) {
            $this->pageView->renderErrorPage(404);
        }
        foreach ($this->requests as $request) {
            $request->tags = $this->sortStrings($request->tags);
        }
        $this->adminView = new RequestsPageView($this->requests);
        $this->pageView->renderPage('Requests', $this->menuView->getMenu(), $this->adminView->getContent());
    }

    public function showDetailedRequest(int $id): void
    {
        $this->request = Project::getDetailedProjectById($id);
        if (is_null($this->request)) {
            $this->pageView->renderErrorPage(404);
            return;
        }
        $this->request->tags = $this->sortStrings($this->request->tags);
        $this->detailedRequestView = new DetailedRequestPageView($this->request);
        $this->pageView->renderPage($this->request->name, $this->menuView->getMenu(), $this->detailedRequestView->getContent());
    }

    public function handleRequestStatus(int $id): void
    {
        if (isset($_POST['status']) and is_string($_POST['status']) and isset($_POST['message']) and is_string($_POST['message'])) {
            $this->request = Project::findById($id);
            if (is_null($this->request)) {
                $this->pageView->renderErrorPage(404);
                return;
            }
            $this->request->status = $_POST['status'];
            $this->request->message = $_POST['message'];
            $this->request->save();
            $this->pageView->redirectToUrl('/requests');
        }
    }
}