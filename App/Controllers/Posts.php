<?php

namespace App\Controllers;


use \Core\View;
use App\Models\Post;
use App\Auth;

class Posts extends  \Core\Controller
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
    
    /**
     * Posts index
     * 
     * @return void
     */
    public function indexAction()
    {
     
           
        $posts = POST::getAll();
        
        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    public function addNewAction()
    {
        echo "Hello from the Posts Controller addNew action";
    }

    public function editAction()
    {
        echo 'Hello from the edit action in the Posts Controller';
        echo '<p>Route parameters:<pre>';
            htmlspecialchars(print_r($this->route_params)) . '</pre></p>';
    }
}