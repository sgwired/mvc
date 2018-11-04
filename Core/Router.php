<?php
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
}
