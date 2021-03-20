<?php
    spl_autoload_register();
    function autoLoader($classname) {
        $path = "classes/";
        $extension = ".class.php";
        $fullpath = $path . $classname . $extension;
        
        if(!file_exists($fullpath)){
            return false;
        }

        include_once $fullpath;
    }
?>