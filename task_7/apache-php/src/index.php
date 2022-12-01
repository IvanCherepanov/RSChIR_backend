<?php
require 'mvc_app/lib/dev.php'; // debug
use mvc_app\core\Router;
use mvc_app\lib\Db;

spl_autoload_register(function($class){ //autoload classes
    $path = str_replace('\\', '/', $class .'.php');
    #debug($path);
    #echo $path;
    if (file_exists($path)) {
        require $path;
    }
});

session_start();
$router = new Router;
$router->run();