<?php
    $base_url = 'http://localhost/MVC/';
    define('BASE_DIR' , '/MVC/');
    $tmp = explode('?' , $_SERVER['REQUEST_URI']);
    $current_route = str_replace(BASE_DIR,'',$tmp[0]);
    unset($tmp);

    $dbHost = 'localhost';
    $dbName = 'MVC';
    $dbUsername = 'root';
    $dbPassword = '';
    
?> 
