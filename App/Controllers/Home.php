<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller
{

    protected function before()
    {
        // echo " (before)";
        // return false;
    }
    
    protected function after()
    {
        // echo " (after)";
    }

    public function indexAction()
    {
        // View::render('Home/index.php', [
        //     'name' => 'Shelton',
        //     'cars' => ['GMC', 'Prius']
        // ]);
        View::renderTemplate('Home/index.html', [
            'name' => 'Shelton',
            'cars' => ['GMC', 'Prius', 'Model 3']
        ]);
    }

  
}