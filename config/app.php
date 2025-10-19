<?php

    define("APP_TITLE","Movie Hub");

    define("BASE_URL","http://localhost:5000");

    define("BASE_DIR",realpath(dirname(__DIR__)).`/../`);

    $temporary = str_replace(BASE_URL,"",explode("?",$_SERVER["REQUEST_URI"])[0]);
    $temporary === '/' ? $temporary = '': $temporary = substr($temporary,1);

    define('CURRENT_ROUTE',$temporary);

    global $routes;

    $routes = [
        'get' => [],
        'post' => [],
        'put' => [],
        'delete'=> []
    ];

?>