<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller
{

    protected function before()
    {

    }
    
    protected function after()
    {

    }

    public function indexAction()
    {
//         View::renderTemplate('Home/index.html', [
//             'name' => 'Shelton',
//             'cars' => ['GMC', 'Prius', 'Model 3', 'Rivian RT']
//         ]);

        View::renderTemplate('Home/index.html');
    }

  
}