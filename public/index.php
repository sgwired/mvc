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
$router->add('{controller}/{action}');
$router->add('login', ['controller' => 'Login', 'action'=> 'new']); # so we can have /login route

// $router->add('{controller}/{id:\d+}/{action}');
// $router->add('posts', ['controller' => 'Posts', 'action'=> 'index']);
// $router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->dispatch($_SERVER['QUERY_STRING']);
