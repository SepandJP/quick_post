<?php

/*
 * require main files
 * */

// Load Config
require_once 'config/config.php';

// Autoload Core Libraries
spl_autoload_register(function ($className)
{
    $libraryPath = 'libraries/' . $className . '.php';
   require_once $libraryPath;
});
