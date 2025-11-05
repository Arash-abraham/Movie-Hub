<?php

    require_once("../config/app.php");
    require_once("../config/database.php");
    
    require_once("../routes/web.php");
    require_once("../routes/api.php");

    $category = \App\Models\Category::all();
    // dd($category);
    print_r($category);
    exit;
    $routing = new \System\Router\Routing();
    $routing->run();
    
?>