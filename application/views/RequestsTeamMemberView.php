<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;

class RequestsTeamMemberView extends View
{
    private array $declinedRequests;
    private array $pendingRequests;
    private array $activeRequests;
    private string $pathToRequestsTemplate;

    public function __construct(?array $declinedRequests, array $pendingRequests, array $activeRequests)
    {
        $this->declinedRequests = $declinedRequests;
        $this->pendingRequests = $pendingRequests;
        $this->activeRequests = $activeRequests;
        $this->pathToRequestsTemplate = dirname(__DIR__, 1) . "/views/templates/requestsTeamMember.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToRequestsTemplate, [
            'declinedRequests' => $this->declinedRequests,
            'pendingRequests' => $this->pendingRequests,
            'activeRequests' => $this->activeRequests,
        ]);
    }
}