<?php
    $base_url = 'http://localhost/Movie-Hub/';
    define('BASE_DIR' , '/Movie-Hub/');
    $tmp = explode('?' , $_SERVER['REQUEST_URI']);
    $current_route = str_replace(BASE_DIR,'',$tmp[0]);
    unset($tmp);

    $dbHost = 'localhost';
    $dbName = 'Movie-Hub';
    $dbUsername = 'root';
    $dbPassword = '';
    
?> 
