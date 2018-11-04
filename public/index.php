<?php


/**
 *  Autoloader
 */
spl_autoload_register(function ($class) {
  $root = dirname(__DIR__);
  $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
  if (is_readable($file)){
    require $root . '/' . str_replace('\\', '/', $class) . '.php';
  }
});



$router = new Core\Router();

// Routing table
$router->add('', ['controller' => 'Home', 'action'=> 'index']);
$router->add('posts', ['controller' => 'Posts', 'action'=> 'index']);
// $router->add('posts/new', ['controller' => 'Posts', 'action'=> 'new']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{action}/{controller}');


$url = $_SERVER['QUERY_STRING'];

if($router->match($url)){
  echo '<pre>';
  var_dump($router->getParams());
  echo '</pre>';
} else {
  echo "No route found for URL '$url'";
}

$router->dispatch($_SERVER['QUERY_STRING']);
