<?php

namespace mvc_app\core;

use mvc_app\core\View;

abstract class Controller {

    public $route;
    public $view;
    public $model;

    public function __construct($route) {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name) {
        $path = 'mvc_app\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }


}