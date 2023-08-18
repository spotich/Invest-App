<?php

namespace InvestApp\application\views;

use InvestApp\application\core\View;

class PageView extends View
{
    private string $pathToDefaultLayout;
    private string $pathToErrorLayout;

    public function __construct()
    {
        $this->pathToDefaultLayout = dirname(__DIR__, 1) . "/views/layouts/default.php";
        $this->pathToErrorLayout = dirname(__DIR__, 1) . "/views/layouts/error.php";
    }

    public function renderPage(string $title, string $menu, string $content): void
    {
        if (file_exists($this->pathToDefaultLayout)) {
            echo $this->renderTemplate($this->pathToDefaultLayout, [
                'title' => $title,
                'menu' => $menu,
                'content' => $content,
            ]);
        } else {
            $this->renderErrorPage(404);
        }
    }

    public function renderErrorPage(int $ErrorCode): void
    {
        http_response_code($ErrorCode);
        echo $this->renderTemplate($this->pathToErrorLayout, [
            'code' => $ErrorCode,
        ]);
    }
}