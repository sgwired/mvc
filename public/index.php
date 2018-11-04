<?php

// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';
require '../Core/Router.php';
$router = new Router();
//echo get_class($router);
// Routing table
$router->add('', ['controller' => 'Home', 'action'=> 'index']);
$router->add('posts', ['controller' => 'Posts', 'action'=> 'index']);
// $router->add('posts/new', ['controller' => 'Posts', 'action'=> 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');

echo '<pre>';
// var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

$url = $_SERVER['QUERY_STRING'];

if($router->match($url)){
  echo '<pre>';
  var_dump($router->getParams());
  echo '</pre>';
} else {
  echo "No route found for URL '$url'";
}

