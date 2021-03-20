<?php
    spl_autoload_register();
    function autoLoader($classname) {
        $path = "classes/";
        $extension = ".class.php";
        $fullpath = $path . $classname . $extension;
        include_once $fullpath;
    }
    include_once('templates/index.html');
?>