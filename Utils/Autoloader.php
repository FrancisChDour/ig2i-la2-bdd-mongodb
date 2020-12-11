<?php

namespace App\Utils;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        $class = str_replace('App', '', $class);
        require __DIR__. '/../' . str_replace('\\', '/', $class) . '.php';
    }
}