<?php

include_once('Router.php');

function baseUrl() {
    return 'http://localhost/chatphp';
}

$router = new Router();
$router->route();

?>