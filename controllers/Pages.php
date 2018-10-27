<?php

class Pages {
    
    function __construct() {
        
    }
    
    function home() {
        require_once(__DIR__.'/../views/home.php');
    }
    
    function notfound() {
        require_once(__DIR__.'/../view/notfound.php');
    }
}

?>