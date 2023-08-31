<?php

namespace InvestApp\application\core;

class View
{
    protected string $message = '';

    public function renderTemplate($pathToTemplate, $parameters = []): ?string
    {
        if (file_exists($pathToTemplate)) {
            extract($parameters);
            ob_start();
            require $pathToTemplate;
            $document = ob_get_clean();
            return is_string($document) ? $document : null;
        } else {
            return null;
        }
    }

    public function setMessage(string $message): void
    {
        if ($message !== '') {
            $this->message = $message;
        }
    }

    public function clearMessage(): void
    {
        $this->message = '';
    }

    public function redirectToUrl($url)
    {
        header("location: $url");
        exit;
    }
}