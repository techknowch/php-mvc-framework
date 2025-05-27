<?php

require_once __DIR__ . '/vendor/autoload.php';
use APP\Core\Application;

$app = new Application();


$app->router->get('/', function() {
    return 'Welcome to the home page!';
});

$app->run();