<?php

namespace Core;

class View
{
    public static function render($view)
    {
        $file = "../App/Views/$view";  // relative to core folder

        if (is_readable($file)){
            require $file;
        } else {
            echo "The view $file not fould";
        }
    }
}