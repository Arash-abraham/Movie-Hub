<?php

    namespace System\Database\Traits;
    
    trait HasMethodCaller {
        private $allMethods = [
            'create','update','delete',
            'find' , 'all' , 'save' ,
            'where' , 'whereOr' , 'whereNull',
            'whereIn' , 'whereNotNull' , 'limit' ,
            'orderBy' , 'get' , 'paginate'
        ];

        private $allowedMethods = [
            'create','update','delete',
            'find' , 'all' , 'save' ,
            'where' , 'whereOr' , 'whereNull',
            'whereIn' , 'whereNotNull' , 'limit' ,
            'orderBy' , 'get' , 'paginate'
        ];
    } 

?>