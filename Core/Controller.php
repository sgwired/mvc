<?php

namespace Core;

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
}