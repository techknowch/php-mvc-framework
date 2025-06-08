<?php

require_once __DIR__ . '/../vendor/autoload.php';
use APP\Core\Application;

$app = new Application(dirname(__DIR__));


$app->router->get('/', 'home');

$app->router->get('/about', function() {
    return 'This is the about page.';
});

$app->router->get('/contact', 'contact');
$app->router->post('/contact', function() {
    return 'This is the contact page.';
});

$app->run();