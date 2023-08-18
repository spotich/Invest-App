<?php

namespace InvestApp\application\core;

class Router
{
    private static $routes = [];
    private static $params = [];

    public static function bindRoutes(): void
    {
        $routes = require dirname(__DIR__, 1) . '/config/routes.php';
        foreach ($routes as $route => $params) {
            Router::addRoute($route, $params);
        }
    }

    public static function addRoute($route, $params): void
    {
        Router::$routes[$route] = $params;
    }

    public static function hasRoute(): bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach (Router::$routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                Router::$params = $params;
                if (isset($matches[1])) {
                    Router::$params['argument'] = $matches[1];
                }
                return true;
            }
        }
        return false;
    }

    public static function run(): void
    {
        $container = new DIContainer();
        if (Router::hasRoute()) {
            $Controller = Router::$params['controller'];
            $action = Router::$params['action'];
            if (class_exists($Controller) and method_exists($Controller, $action)) {
                if ($container->has($Controller)) {
                    $controller = $container->get($Controller);
                }
                $reflection = new \ReflectionMethod($Controller, $action);
                $actionParametersCount = $reflection->getNumberOfParameters();
                if ($actionParametersCount === 1 and isset(Router::$params['argument'])) {
                    $argument = Router::$params['argument'];
                    isset($controller) ? $controller->$action($argument) : $Controller::$action($argument);
                } else {
                    isset($controller) ? $controller->$action() : $Controller::$action();
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}