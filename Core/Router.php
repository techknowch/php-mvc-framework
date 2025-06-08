<?php

namespace APP\Core;


class Router {
    public Request $request;
    public Response $response;
    protected array $routes = [
        'get' => [],
        'post' => [],
        'put' => [],
        'delete' => [],
        'patch' => [],
        'options' => [],
        'head' => [],
    ];
    public function __construct(Request $request, Response $response = null) {
        $this->request = $request;
        if ($response === null) {
            $this->response = new Response();
        } else {
            $this->response = $response;
        }
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
            // Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            // If no callback is found, handle the 404 Not Found error
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
        $layoutContent = $this->renderLayout();
        $veiwContent = $this->renderOnlyView($viewName, $params);
        echo str_replace('{{content}}', $veiwContent, $layoutContent);
        /*
        $viewPath = Application::$ROOT_DIR . '/views/' . $viewName . '.php';
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "View not found: " . htmlspecialchars($viewName);
            return;
        }
        extract($params);
        require_once $viewPath;
        */
    }

    protected function renderLayout(): string {
        $layoutPath = Application::$ROOT_DIR . '/views/layouts/main.php';
        if (!file_exists($layoutPath)) {
            http_response_code(404);
            echo "Layout not found.";
            return '';
        }
        ob_start();
        require_once $layoutPath;
        return ob_get_clean();
    }

    protected function renderOnlyView(string $viewName, array $params = []): void {
        $viewPath = Application::$ROOT_DIR . '/views/' . $viewName . '.php';
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "View not found: " . htmlspecialchars($viewName);
            return;
        }
        extract($params);
        require_once $viewPath;
    }

}