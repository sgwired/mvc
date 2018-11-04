<?php

namespace App\Controllers;

class Posts extends  \Core\Controller
{
    public function index()
    {
        echo "Hello from the Post Controller index action";
        echo '<p> Query string parametrs:<pre>' .
            htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    }

    public function addNew()
    {
        echo "Hello from the Posts Controller addNew action";
    }

    public function edit()
    {
        echo 'Hello from the edit action in the Posts Controller';
        echo '<p>Route parameters:<pre>';
            htmlspecialchars(print_r($this->route_params)) . '</pre></p>';
    }
}