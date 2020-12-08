<?php 
    spl_autoload_register(function ($class_name) {
        $dirs = array("classes", "controllers", "models");

        $found = false;
        foreach($dirs as $dir) {
            if (file_exists($dir . '/' . $class_name . '.php')) {
                require($dir . '/' . $class_name . '.php');    
                $found = true;
                break;
            }
        }
        if (!$found) {
            trigger_error("Could not find class/interface/abstract class: " . $class_name, E_USER_WARNING);
            debug_print_backtrace();
        }
    });
?>