<?php

    session_start();

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