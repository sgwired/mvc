<?php

namespace Core;

class Router
{
  protected $routes = [];
  protected $params = [];

  /**
   * Add route to virtual routing table
   * @param = string $route
   * @param = array $params  controller action id in any order
   */
  public function add($route, $params = [])
  {
    // convert route to regex and git rid of forward slashes
    $route = preg_replace('/\//', '\\/', $route);

    // Convert variables {Controller}
    $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

    // Convert varialbles looking for id
    $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

    // Add start and end delimeters and case insensitive 
    $route = '/^' . $route . '$/i';

    $this->routes[$route] = $params;
  }

  public function getRoutes()
  {
    return $this->routes;
  }

  public function match($url)
  {
    foreach($this->routes as $route => $params){
      if(preg_match($route, $url, $matches)){
        foreach($matches as $key => $match){
          if(is_string($key)){
            $params[$key] = $match;
          }
        }
        $this->params = $params;
        return true;
      }
    }

    return false;
  }

  public function getParams()
  {
    return $this->params;
  }

  /**
   * @param  string $url 
   * @return void
   * 
   * convert controller to StudlyCaps
   */
  public function dispatch($url)
  {
    if ($this->match($url)){
      $controller = $this->params['controller'];
      $controller = $this->convertToStudlyCaps($controller);
      $controller = "App\Controllers\\$controller";

      if(class_exists($controller)){
        $controller_object = new $controller();

        $action = $this->params['action'];
        $action = $this->convertToCamelCase($action);

        if(is_callable([$controller_object, $action])){
          $controller_object->$action();
        } else {
          echo "Method $action (in controller $controller) not found.";
        }
      } else {
        echo "Controller class $controller not found";
      }
    } else {
      echo "No route matched.";
    }
  }

  /**
   * Convert string with - to StudlyCaps
   *  $blog-authors => BlogAuthors
   *  @param string $string The string to convert
   *  @return string
   */
  protected function convertToStudlyCaps($string)
  {
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
  }

  /**
   * Convert string with - the camelCase
   * $blog-authors => blogAuthors
   *  @param string $string to covert
   *  @return string
   */
  protected function convertToCamelCase($string)
  {
    return lcfirst($this->convertToStudlyCaps($string));
  }
}
