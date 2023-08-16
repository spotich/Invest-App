<?php

require '../application/config/constants.php';

spl_autoload_register(function ($class) {
    $name = explode(NAMESPACE_NAME, str_replace('\\', '/', $class))[1];
    $file = dirname(__DIR__, 1) . '/' . $name . '.php';
    require $file;
});

use InvestApp\application\core\Router;

session_start();
Router::bindRoutes();
Router::run();