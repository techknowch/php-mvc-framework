<?php

namespace APP\Core;

class Application {

    public static sring $ROOT_DIR;
    public Router $router;
    public Request $request;

    public function __construct($rootPath) {
        // Set the root path for the application
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }


    public function run() {
        $this->router->resolve();
    }

}