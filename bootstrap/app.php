<?php
    // dd helper funcrtion
    
    function dd(...$args) {
        foreach ($args as $arg) {
            print '<pre style="background: #f4f4f4; padding: 10px; border: 1px solid #ccc; margin: 5px;">';
            var_dump($arg);
            print '</pre>';
        }
        die(1);
    }

    require_once("../config/app.php");
    require_once("../config/database.php");
    
    require_once("../routes/web.php");
    require_once("../routes/api.php");



    $routing = new \System\Router\Routing();
    $routing->run();
    
?>