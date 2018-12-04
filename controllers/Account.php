<?php

include_once('models/User.php');

class Account {
    
    private $user_model;

    public function __construct() {
        $this->user_model = new User();
    }
    
    function submitLogin() {
        $data = $_POST;
        if(!isset($data['name']) || !isset($data['password']))
            die(json_encode(['error'=>'Missing data.']));
        $response = $this->user_model->login($data);
        die(json_encode($response));
    }
    
    function submitSignup() {
        $data = $_POST;
        if(!isset($data['name']) || !isset($data['password']))
            die(json_encode(['error'=>'Missing data.']));
        $response = $this->user_model->register($data);
        die(json_encode($response));
    }
    
    function login() {
        require_once(__DIR__.'/../views/account/login.php');
    }
    
    function signup() {
        require_once(__DIR__.'/../views/account/signup.php');
    }
}

?>