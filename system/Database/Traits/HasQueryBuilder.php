<?php

    namespace System\Database\Traits;

    use System\Database\DBConnection\DBConnection;

    trait HasQueryBuilder {
        private $sql = "";
        protected $where = []; 
        
    }


?>