<?php

/**
 * Composer autoloader
 */
require '../vendor/autoload.php';


/**
 *  Twig register the twig package
 */
Twig_Autoloader::register();

/**
 * Error and Exception handlers
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
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
