<?php
namespace App\Controllers;

use Core\Controller;

/**
 * 
 * @author sheltong
 *
 * Authenticated base controller
 * 
 * PHP version 7
 */
abstract class Authenticated extends Controller
{
    /**
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */
    protected function before()
    {
        $this->requireLogin();
    }
    
}

