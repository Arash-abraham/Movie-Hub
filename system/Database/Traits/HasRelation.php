<?php

    namespace System\Database\Traits;

    trait HasRelation {
        protected function hasOne($model , $foreignKey , $localKey) {
            if($this->{$this->primaryKey}) {
                $modelObject = new $model();
                return $modelObject->getHasOneRelation($this->table , $foreignKey , $localKey , $this->$localKey);
            }
        }

        public function hasMany($model , $foreignKey , $otherKey) {
            if($this->{$this->primaryKey}) {
                $className = "\\App\\" . $model;
                $modelObject = new $className();
                return $modelObject->getHasRelation($this->table , $foreignKey , $otherKey , $this->$otherKey);
            }
        }

        public function blongsTo($model , $foreignKey , $localKey) {
            if($this->{$this->primaryKey}) {
                $className = "\\App\\" . $model;
                $modelObject = new $className();
                return $modelObject->getBlongsToRelation($this->table , $foreignKey , $localKey , $this->$foreignKey);
            }
        }
        
        protected function belongsToMany($model, $commonTable, $localKey, $middleForeignKey, $middleRelation, $foreignKey ) {
            if($this->{$this->primaryKey}) {
                $className = "\\App\\" . $model;
                $modelObject = new $className();
                return $modelObject->getBelongsToManyRelation($this->table, $commonTable , $localKey, $this->$localKey, $middleForeignKey, $middleRelation, $foreignKey);
            }
        }
        protected function getBelongsToManyRelation($table, $commonTable, $localKey, $localKeyValue, $middleForeignKey, $middleRelation, $foreignKey) {
            /* 
                If we didn't have this method, 
                we would have to write a command like this for everytime =>
                    $sql = "SELECT posts.* FROM 
                    ( SELECT category_post.* FROM 
                    categories JOIN category_post on categories.id = category_post.cat_id WHERE  categories.id = ? ) 
                    as relation JOIN posts on relation.post_id=posts.id ";            
            */
            $this->setSql("SELECT `c`.* FROM ( SELECT `b`.* FROM `{$table}` AS `a` JOIN `{$commonTable}` AS `b` on `a`.`{$localKey}` = `b`.`{$middleForeignKey}` WHERE  `a`.`{$localKey}` = ? ) AS `relation` JOIN ".$this->getTableName()." AS `c` ON `relation`.`{$middleRelation}` = `c`.`$foreignKey`");
            $this->addValue("{$table}_{$localKey}", $localKeyValue);
            $this->table = 'c';
            return $this;
        }
        public function getBlongsToRelation($table , $foreignKey , $otherKey , $foreignKeyValue) {
            /* 
                If we didn't have this method, 
                we would have to write a command like this for everytime =>
                    $sql = "SELECT posts.* FROM categories JOIN posts on categories.id = posts.cat_id"
            */

            $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN ".$this->getTableName()." AS `b` on `a`.`{$foreignKey}` = `b`.`{$otherKey}` ");
            $this->setWhere('AND',"`a`.`$foreignKey` = ?");
            $this->table = 'b';
            $this->addValue($foreignKey,$foreignKeyValue);
            $statement = $this->executeQuery();
            $data = $statement->fetch();
            if($data) {
                return $this->arratyToAttributes($data);
            }            
            return NULL;        }

        public function getHasManyRelation($table , $foreignKey , $otherKey , $otherKeyValue) {
            /* 
                If we didn't have this method, 
                we would have to write a command like this for everytime =>
                    $sql = "SELECT posts.* FROM categories JOIN posts on categories.id = posts.cat_id"
            */

            $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN ".$this->getTableName()." AS `b` on `a`.`{$otherKey}` = `b`.`{$foreignKey}` ");
            $this->setWhere('AND',"`a`.`$otherKey` = ?");
            $this->table = 'b';
            $this->addValue($otherKey,$otherKeyValue);
            return $this;
        }

        public function getHasOneRelation($table , $foreignKey , $otherKey , $otherKeyValue) {
            /* 
                If we didn't have this method, 
                we would have to write a command like this for everytime =>
                    $sql = "SELECT phones.* FROM users JOIN phones on users.id = phones.user_id"
            */

            $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN ".$this->getTableName()." AS `b` on `a`.`{$otherKey}` = `b`.`{$foreignKey}` ");
            $this->setWhere('AND',"`a`.`$otherKey` = ?");
            $this->table = 'b';
            $this->addValue($otherKey,$otherKeyValue);
            $statement = $this->executeQuery();
            $data = $statement->fetch();
            if($data) {
                return $this->arratyToAttributes($data);
            }            
            return NULL;
        }

    }

?>