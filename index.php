<?php

include_once('Router.php');
define('ERROR', 'HTTP/1.1 400 Bad Request');
define('SUCCESS', 'HTTP/1.1 200 OK');

function baseUrl() {
    return 'http://localhost/chatphp';
}

date_default_timezone_set('America/Sao_Paulo');
session_start();
$router = new Router();
$router->route();

?>