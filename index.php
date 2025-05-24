<?php

require_once 'core/Application.php';

$app = new Application();

$router = new Router();

$app->router->get('/', function() {
    return 'Welcome to the home page!';
});

$app->run();