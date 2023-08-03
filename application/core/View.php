<?php

namespace application\core;

use JetBrains\PhpStorm\NoReturn;

class View
{
    public static string $layout = 'default';

    public static function render($template, $vars = []): void {
        extract($vars);
        ob_start();
        require dirname(__DIR__, 1) . "/views/templates/$menu.php";
        $menuContent = ob_get_clean();

        ob_start();
        require dirname(__DIR__, 1) . "/views/templates/$template.php";
        $content = ob_get_clean();

        require  dirname(__DIR__, 1) . '/views/layouts/'.View::$layout.'.php';
    }

    #[NoReturn] public static function redirect($url): void {
        header("location: $url");
        exit;
    }

    #[NoReturn] public static function errorCode($code): void {
        http_response_code($code);
        ob_start();
        require dirname(__DIR__, 1) . "/views/errors/$code.php";
        $content = ob_get_clean();
        require dirname(__DIR__, 1) . "/views/layouts/default.php";
        exit;
    }
}