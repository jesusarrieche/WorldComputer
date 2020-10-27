<?php
require_once 'system/Core/Config.php';
require_once 'vendor/autoload.php';

$router = new \System\Core\Router();

if(!isset($_SESSION)) {
    session_start();
}

// $_SESSION['isAuth'] = false;

// session_destroy();

// var_dump($_SESSION);


if(!empty($_SESSION['usuario'])) {
    
    if( $router->getController() == 'api' ){
        $controller = "App\\Api\\" . $router->getController();
        $method = $router->getMethod();
        $param = $router->getParam();
    
        $controller = new $controller();
        $controller->$method($param);
    
    }else{
        $controller = "App\\Controllers\\" . $router->getController() . "Controller";
        $method = $router->getMethod();
        $param = $router->getParam();
        
        $controller = new $controller();
        $controller->$method($param);
    }
    
} else {
    
    $controller = "App\\Controllers\\LoginController";
    $method = $router->getMethod();
    $param = $router->getParam();
    
    $controller = new $controller();
    $controller->$method($param);
}




