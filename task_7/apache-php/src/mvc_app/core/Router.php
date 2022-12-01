<?php

namespace mvc_app\core;

class Router {

    protected $routes = [];
    protected $params = [];

    public function __construct() {
        $arr = require 'mvc_app/config/routers.php';
        foreach ($arr as $key => $val){
            #echo ($key);
            $this->add($key, $val);
        }
    }

    public function add($route, $params){
        $route = '#^'.$route.'$#';
        #$route = '#'.$route.'#';
        $this->routes[$route] = $params;
    }

    public function match(){
        $url = trim($_SERVER['REQUEST_URI'], '/');
        if (strpos($url, "?")){
            $temp =  substr($url, strrpos($url, '?') + 1);
            $ress = strlen($temp);
            $repl = mb_substr($url, 0, strlen($url)-$ress-1);
            $url = $repl;
        }
        #debug($url);
        #debug($this->routes);
        foreach ($this->routes as $route => $params){
            #debug($route);
            #debug($url);

            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
            #var_dump($matches);
            #debug("vad");
        }
        return false;
    }

    public function run(){
        #debug("start");
        if ($this->match()) {
            #echo "21";
            $path = 'mvc_app\controllers\\' .ucfirst($this->params['controller']).'Controller';
            #debug( $path);
            #debug(class_exists($path));
            #echo "2";
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                #debug($action);
               # echo "3";
                if (method_exists($path, $action)) {
                    #echo "4";
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    #echo "5";
                    View::errorCode(404, 'Controller method not found');
                }
            } else {
                #echo "6";
                View::errorCode(404, 'Controller clas not found');
            }
        } else {
            #debug("else in run");
            View::errorCode(404, 'Unavailable URL');
        }
        #debug("end");
    }
}