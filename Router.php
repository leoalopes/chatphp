<?php

include_once('controllers/Generalpages.php');
include_once('controllers/Account.php');
include_once('controllers/Logged.php');

class Router {
    public $route = [];

    private function stripBlanks($route) {
        foreach($route as $key => $value) {
            if(empty($value)) unset($route[$key]);
        }
        return array_values($route);
    }

    private function getRoute() {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        if(strstr($uri, '?'))
            $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = trim($uri, '/');
        $route = explode('/', $uri);
        unset($route[0]);
        return $route;
    }
    
    public function __construct() {
        $this->route = $this->stripBlanks($this->getRoute());
    }
    
    public function route() {
        if(empty($this->route)) {
            $this->home();
        } else {
            if(count($this->route) == 1) {
                $route = $this->route[0];
                if(method_exists($this, $route))
                    $this->$route();
                else
                    $this->notFound();
            } else {
                $this->notFound();
            }
        }
    }
    
    private function home() {
        $controller = new Generalpages();
        $controller->home();
    }
    
    private function login() {
        $controller = new Account();
        $controller->login();
    }
    
    private function submitLogin() {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
            header('location: '.baseUrl().'/login');
        else {
            $controller = new Account();
            $controller->submitLogin();
        }
    }
    
    private function signup() {
        $controller = new Account();
        $controller->signup();
    }
    
    private function panel() {
        $controller = new Logged();
        $controller->panel();
    }
    
    private function notFound() {
        $controller = new Generalpages();
        $controller->notFound();
    }
}

?>