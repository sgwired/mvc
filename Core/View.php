<?php

namespace Core;

class View
{
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        
        $file = "../App/Views/$view";  // relative to core folder

        if (is_readable($file)){
            require $file;
        } else {
            echo "The view $file not found";
        }
    }
}