<?php
    session_start();
    require_once 'System/config.php';
    require_once 'System/Bootstrap/Autoload.php';

    $autoload = new \System\Bootstrap\Autoload();
    $autoload->Loader();

    $router = new \System\Router\Routing();
    $router->Run();
?>
