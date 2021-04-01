<?php
    session_start();
    
    $GLOBALS['config'] = array(
        'mysql' => array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'db' => 'login'
        ),
        'remember' => array(
            'cookie_name' => 'hash',
            'cookie_expiry' => 604800
        ),
        'session' => array(
            'session_name' => 'user'
        )
    );
    /*
    $GLOBALS['config'] = array(
        'mysql' => array(
            'host' => 'remotemysql.com',
            'username' => 'boNYa9W5zw',
            'password' => 'tcT3WJXcxX',
            'db' => 'boNYa9W5zw'
        ),
        'remember' => array(
            'cookie_name' => 'hash',
            'cookie_expiry' => 604800
        ),
        'session' => array(
            'session_name' => 'user'
        )
    );
    */
    spl_autoload_register(function($class){
        require_once 'classes/' . $class . '.php';
    });
?>
