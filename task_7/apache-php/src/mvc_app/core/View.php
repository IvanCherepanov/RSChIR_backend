<?php

namespace mvc_app\core;

class View {

    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars = []) {
        extract($vars);
        $path = 'mvc_app/views/'.$this->path.'.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'mvc_app/views/layouts/'.$this->layout.'.php';
        }
    }

    public function redirect($url) {
        header('location: '.$url);
        exit;
    }

    public static function errorCode($code) {
        http_response_code($code);
        $path = 'mvc_app/views/errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));
    }

    public static function json($json, $code){
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: *");
        http_response_code($code);
        require 'mvc_app/views/json.php';
    }
}