<?php

namespace InvestApp\application\views\pages;

use InvestApp\application\core\View;

class RequestsPageView extends View
{
    private array  $requests;
    private string $pathToRequestsTemplate;

    public function __construct(?array $requests)
    {
        $this->requests = $requests;
        $this->pathToRequestsTemplate = dirname(__DIR__, 1) . "/templates/adminRequests.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->pathToRequestsTemplate, [
            'requests' => $this->requests,
        ]);
    }
}