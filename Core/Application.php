<?php

namespace APP\Core;

class Application {

    public Router $router;

    public function __construct() {
        $this->router = new Router();
    }


    public function run() {
        
    }

}