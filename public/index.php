<?php

    use App\core\Router;

    define('ROOT', dirname(__DIR__));
    require_once ROOT . '/vendor/autoload.php';

    $app = new Router();
    $app->start();

