<?php

/**
 *  Twig
 */
require_once dirname(__DIR__) . '/vendor/Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();


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
// $router->add('admin/{action}/{controller}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

// $url = $_SERVER['QUERY_STRING'];

// if($router->match($url)){
//   echo '<pre>';
//   var_dump($router->getParams());
//   echo '</pre>';
// } else {
//   echo "No route found for URL '$url'";
// }

$router->dispatch($_SERVER['QUERY_STRING']);
