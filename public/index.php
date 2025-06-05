<?php

require_once __DIR__ . '/../vendor/autoload.php';
use APP\Core\Application;

$app = new Application();


$app->router->get('/', function() {
    return 'Welcome to the home page!';
});

$app->router->get('/about', function() {
    return 'This is the about page.';
});

$app->router->get('/contact', function() {
    return 'This is the contact page.';
});

$app->run();