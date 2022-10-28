<?php

namespace Core;

use App\Auth;

/**
 * Base controller
 */

abstract class Controller 
{
    /**
     *  @var = array parameters from the matched route
     */
    protected $route_params = [];

    /**
     *  Class constructor
     *  @param array $route_params 
     *  @return void
     */
    public function  __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)){
            if($this->before() !== false){
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     *  Before Middleware (filter) - called before an action method
     */
    protected function before()
    {

    }

    /**
     *  After Middleware (filter) - called after action method
     */
     protected function after()
     {

     }
     
     
     /**
      * Redirect to a different page
      * 
      * @param string $url The relative URL
      * 
      * @return void
      */
      public function redirect($url)
      {
          header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
          exit;
      }
      
      /**
       * Require the user to be logged in before giving access to the requested page.
       * Remeber the requested page for later, then redirect to the login page
       * 
       * @return void
       */
       public function requireLogin()
       {
           if(! Auth::isLoggedIn()) {
               
               Auth::rememberRequestedPage();
               
               $this->redirect('/login');
           }
       }
}