<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;

class CreateRequestPageView extends View
{
    private string $relatedTemplate;
    private array $tags;

    public function __construct(array $tags, string $message = '')
    {
        $this->message = $message;
        $this->tags = $tags;
        $this->relatedTemplate = dirname(__DIR__, 1) . "/views/templates/createRequest.php";
    }

    public function getContent(): ?string
    {
        return $this->renderTemplate($this->relatedTemplate, [
            'message' => $this->message,
            'tags' => $this->tags,
        ]);
    }
}