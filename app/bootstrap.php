<?php
//load config file
require_once 'config/config.php';

// all library files goes through bootstrap file.
//Autoload Core libraries - used when you have lots of core libraries

spl_autoload_register(function($className){
    require_once 'libraries/'. $className . '.php';

});