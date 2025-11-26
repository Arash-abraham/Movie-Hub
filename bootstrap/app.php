<?php

    session_start();

    if(isset($_SESSION['old'])) {
        unset($_SESSION['temporary']);
    }
    if(isset($_SESSION['temporaryFlash'])) {
        unset($_SESSION['temporaryFlash']);
    }

    if(isset($_SESSION['old'])) {
        $_SESSION['temporary'] = $_SESSION['old'];
        unset($_SESSION['old']);
    }
    if(isset($_SESSION['flash'])) {
        $_SESSION['temporaryFlash'] = $_SESSION['flash'];
        unset($_SESSION['flash']);
    }

    $params = [];
    $params = !isset($_GET) 
        ?
            $params
        :
            array_merge($params , $_GET); 
    $params = !isset($_POST) 
        ?
            $params
        :
            array_merge($params , $_POST);
    
    $_SESSION['old'] = $params;
    unset($params);

    require_once("../system/Helper/helper.php");


    require_once("../config/routes.php");

    require_once("../config/app.php");
    require_once("../config/database.php");
    
    require_once("../routes/web.php");
    require_once("../routes/api.php");

    require_once("../config/Config.php");

    $routing = new \System\Router\Routing();
    $routing->run();
    
?>