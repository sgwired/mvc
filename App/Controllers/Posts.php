<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Post;

class Posts extends  \Core\Controller
{
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