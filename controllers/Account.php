<?php

class Account {
    
    function __construct() {
        
    }
    
    function submitLogin() {
        header('location: '.baseUrl().'/home');
    }
    
    function submitSignup() {
        header('location: '.baseUrl().'/home');
    }
    
    function login() {
        require_once(__DIR__.'/../views/account/login.php');
    }
    
    function signup() {
        require_once(__DIR__.'/../views/account/signup.php');
    }
}

?>