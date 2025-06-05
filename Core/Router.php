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
    public function get(string $path, callable|string $callback) {
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
        if(is_string($callback)) {
            // If the callback is a string, assume it's a view file
            return $this->renderView($callback);
        }
        return call_user_func($callback, $this->request);
        /*
        echo '<pre>';
        var_dump($callback);
        echo '</pre>';
        */
        /*
        var_dump($path);
        */
    }

    public function renderView(string $viewName, array $params = []): void {
        $viewPath = __DIR__ . '/../views/' . $viewName . '.php';
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "View not found: " . htmlspecialchars($viewName);
            return;
        }
        extract($params);
        require_once $viewPath;
    }

}