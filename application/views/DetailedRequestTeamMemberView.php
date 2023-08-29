<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;
use InvestApp\application\models\Project;

class DetailedRequestTeamMemberView extends View
{
    private string $relatedTemplate;
    private ?Project $request;

    public function __construct(?Project $request)
    {
        $this->request = $request;
        $this->relatedTemplate = dirname(__DIR__, 1) . "/views/templates/detailedRequestTeamMember.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->relatedTemplate, [
            'request' => $this->request,
        ]);
    }
}