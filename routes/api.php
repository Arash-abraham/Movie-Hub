<?php

    use System\Router\Api\Api;

    Api::get('','HomeController@index','index');
    Api::get('create','HomeController@create','create');
    Api::post('store','HomeController@store','store');
    Api::get('edit/{id}','HomeController@edit','edit');

?>