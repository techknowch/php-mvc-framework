<?php

namespace APP\Core;

class Application {

    public Router $router;
    public Request $request;

    public function __construct($rootPath) {
        // Set the root path for the application
        $this->request = new Request();
        $this->router = new Router($this->request);
    }


    public function run() {
        $this->router->resolve();
    }

}