<?php

namespace APP\Core;


class Router {
    public Request $request;
    protected array $routes = [
        'get' => [],
        'post' => [],
        'put' => [],
        'delete' => [],
        'patch' => [],
        'options' => [],
        'head' => [],
    ];
    public function __construct(\APP\Core\Request $request) {
        $this->request = $request;
    }
    public function get(string $path, callable $callback) {
        // Logic to handle GET requests
        $this->routes['get'][$path] = $callback;
    }
    public function resolve() {
        // Logic to resolve the request and call the appropriate callback
        $this->request->getMethod();
        $path = $this->request->getUri();
    }
}