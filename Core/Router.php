<?php

namespace APP\Core;


class Router {
    protected array $routes = [
        'get' => [],
        'post' => [],
        'put' => [],
        'delete' => [],
        'patch' => [],
        'options' => [],
        'head' => [],
    ];
    public function get(string $path, callable $callback) {
        // Logic to handle GET requests
        $this->routes['get'][$path] = $callback;
    }
    public function resolve() {
        // Logic to resolve the request and call the appropriate callback
        var_dump($_SERVER);


    }
}