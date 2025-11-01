<?php

    namespace System\Database\Traits;

    trait HasRelation {
        protected function hasOne($model , $foreignKey , $localKey) {
            if($this->{$this->primaryKey}) {
                $modelObject = new $model;
                return $modelObject->getHasRelation($this->table , $foreignKey , log($this->primaryKey) , $localKey , $this->$localKey);
            }
        }

        public function getHasRelation($table , $foreignKey , $otherKey , $otherKeyValue) {
            /* 
                If we didn't have this method, 
                we would have to write a command like this for everytime =>
                    $sql = "SELECT phones.* FROM users JOIN phones on users.id = phones.user_id"
            */

            $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN ".$this->getTableName()." AS `b`");
        }

    }

?>