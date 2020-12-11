<?php

namespace App;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        $class = str_replace('App\\', '', $class);
        require_once $class . '.php';
    }
}