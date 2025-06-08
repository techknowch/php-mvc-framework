<?php

namespace APP\Core;

class Application {

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;

    public function __construct($rootPath) {
        // Set the root path for the application
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->response = new Response();
    }


    public function run() {
        $this->router->resolve();
    }

}