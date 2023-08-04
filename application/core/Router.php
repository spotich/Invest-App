<?php

namespace application\core;

class Router
{
    private static $routes = [];
    private static $params = [];

    public static function bindRoutes(): void
    {
        $routes = require dirname(__DIR__, 1) . '/config/routes.php';
        foreach ($routes as $route => $params) {
            Router::add($route, $params);
        }
    }

    public static function add($route, $params): void
    {
        Router::$routes[$route] = $params;
    }

    public static function match(): bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach (Router::$routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                Router::$params = $params;
                return true;
            }
        }
        return false;
    }

    public static function run(): void
    {
        if (Router::match()) {
            $Controller = Router::$params['controller'];
            $action = Router::$params['action'];

            if (class_exists($Controller) and method_exists($Controller, $action)) {
                $controller = new $Controller;
                $controller->$action();
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}