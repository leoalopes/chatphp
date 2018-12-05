<?php

include_once('models/Interactions.php');

class Logged {
    
    private $interactions_model;

    function __construct() {
        $this->interactions_model = new Interactions();
    }
    
    function panel() {
        require_once(__DIR__.'/../views/logged/panel.php');
    }

    function message() {
        require_once(__DIR__.'/../views/logged/message.php');
    }

    function profile() {
        require_once(__DIR__.'/../views/logged/profile.php');
    }

    function getMessages() {
        $response = $this->interactions_model->getMessages();
        die(json_encode($response));
    }

    function stayOnline() {
        $this->interactions_model->stayOnline();
        die();
    }

    function getOnline() {
        $response = $this->interactions_model->getOnline();
        die(json_encode($response));
    }

    function sendMessage() {
        $data = $_POST;
        if(!isset($data['text']) || $data['text'] == '')
            die(json_encode(['error'=>'Missing data.']));
        $data['text'] = trim($data['text']);
        if(!isset($data['text']) || $data['text'] == '')
            die(json_encode(['error'=>'Missing data.']));
        $this->interactions_model->sendMessage($data);
        die();
    }

    function getReceiverMessages() {
        $response = $this->interactions_model->getReceiverMessages();
        die(json_encode($response));
    }

    function setReceiver() {
        $data = $_POST;
        if(!isset($data['receiver']))
            die(json_encode(['error'=>'Missing data.']));
        $this->interactions_model->setReceiver($data);
        die();
    }
}

?>