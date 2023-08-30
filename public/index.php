<?php

require '../application/config/constants.php';

spl_autoload_register(function ($className) {
    $namespacePrefix = 'InvestApp';
    $subNamespace = str_replace('InvestApp', '', $className);
    $baseDirectory = str_replace('\\', '/', $subNamespace);
    require dirname(__DIR__, 1) . $baseDirectory . '.php';
});

use InvestApp\application\core\Router;

session_start();
Router::bindRoutes();
Router::run();