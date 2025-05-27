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
        $path = $this->request->getUri();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? null;
        if($callback === null) {
            // Handle 404 Not Found
            http_response_code(404);
            echo "404 Not Found";
            return;
        }
        echo '<pre>';
        var_dump($callback);
        echo '</pre>';
        /*
        var_dump($path);
        */
    }
}