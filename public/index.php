<?php

spl_autoload_register(function ($class) {
    $name = str_replace('\\', '/', $class);
    $file = dirname(__DIR__, 1) . '/' . $name . '.php';
    require $file;
});

use application\core\Router;

session_start();
Router::getRoutes();
Router::run();