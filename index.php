<?php

include_once('controllers/Pages.php');

define('BASEURL', 'http://localhost/chat');

function getRoute() {
	$uri = trim($_SERVER['REQUEST_URI'], '/');
	if(strstr($uri, '?'))
		$uri = substr($uri, 0, strpos($uri, '?'));
	$uri = trim($uri, '/');
	$routes = explode('/', $uri);
    unset($routes[0]);
    return $routes;
}

function stripBlanks(&$route) {
	foreach($route as $key => $value) {
        if(empty($value)) unset($route[$key]);
    }
}

$currentRoute = getRoute();
stripBlanks($currentRoute);

$routed = false;
if(empty($currentRoute)) {
    $controller = new Pages();
    $controller->home();
    $routed = true;
}

if(!$routed) {
    $controller = new Pages();
    $controller->notfound();
}

?>