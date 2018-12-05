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
        if(isset($_SESSION['logged']))
            header('location: '.baseUrl().'/panel');
        $controller = new Generalpages();
        $controller->home();
    }
    
    private function login() {
        if(isset($_SESSION['logged']))
            header('location: '.baseUrl().'/panel');
        $controller = new Account();
        $controller->login();
    }
    
    private function submitLogin() {
        if($_SERVER['REQUEST_METHOD'] != 'POST' && !isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        else {
            $controller = new Account();
            $controller->submitLogin();
        }
    }
    
    private function signup() {
        if(isset($_SESSION['logged']))
            header('location: '.baseUrl().'/panel');
        $controller = new Account();
        $controller->signup();
    }

    private function submitSignup() {
        if($_SERVER['REQUEST_METHOD'] != 'POST' && !isset($_SESSION['logged']))
            header('location: '.baseUrl().'/signup');
        else {
            $controller = new Account();
            $controller->submitSignup();
        }
    }
    
    private function panel() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        $controller = new Logged();
        $controller->panel();
    }

    private function message() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        if(!isset($_SESSION['logged']['receiver']))
            header('location: '.baseUrl().'/panel');
        $controller = new Logged();
        $controller->message();
    }

    private function profile() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        $controller = new Logged();
        $controller->profile();
    }

    private function editProfile() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        if($_SERVER['REQUEST_METHOD'] != 'POST')
            header('location: '.baseUrl().'/profile');
        else {
            $controller = new Account();
            $controller->editProfile();
        }
    }
 
    private function logout() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        $controller = new Account();
        $controller->logout();
    }

    private function sendMessage() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        if(!isset($_SESSION['logged']['receiver']))
            header('location: '.baseUrl().'/panel');
        $controller = new Logged();
        $controller->sendMessage();
    }

    private function refreshReceiver() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        if(!isset($_SESSION['logged']['receiver']))
            header('location: '.baseUrl().'/panel');
        $controller = new Logged();
        $controller->getReceiverMessages();
    }

    private function refreshMessages() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        $controller = new Logged();
        $controller->getMessages();
    }

    private function stayOnline() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        $controller = new Logged();
        $controller->stayOnline();
    }

    private function refreshOnline() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        $controller = new Logged();
        $controller->getOnline();
    }

    private function setReceiver() {
        if(!isset($_SESSION['logged']))
            header('location: '.baseUrl().'/login');
        $controller = new Logged();
        $controller->setReceiver();
    }
    
    private function notFound() {
        $controller = new Generalpages();
        $controller->notFound();
    }
}

?>