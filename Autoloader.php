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
        $class = str_replace('App', '', $class);
//        var_dump(__DIR__. str_replace('\\', '/', $class) . '.php');
        require_once __DIR__ . str_replace('\\', '/', $class) . '.php';
    }
}