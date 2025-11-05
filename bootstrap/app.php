<?php
    require_once("../config/app.php");
    require_once("../config/database.php");
    
    require_once("../routes/web.php");
    require_once("../routes/api.php");

    $category = \App\Models\Category::all();
    dd($category);

    $routing = new \System\Router\Routing();
    $routing->run();
    
?>