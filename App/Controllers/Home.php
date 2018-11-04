<?php

namespace App\Controllers;

class Home extends \Core\Controller
{
    public function indexAction()
    {
        echo "Hello from the Home Controller index action";
    }

    protected function after()
    {
        echo " (after)";
    }

    protected function before()
    {
        echo " (before)";
    }
}