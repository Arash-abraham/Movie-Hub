<?php

    namespace System\Database\Traits;

    trait HasRelation {
        protected function hasOne($model , $foreignKey , $localKey) {
            if($this->{$this->primaryKey}) {
                $className = "\\App\\Models\\" . $model;
                $modelObject = new $className();
                return $modelObject->getHasOneRelation($this->table , $foreignKey , $localKey , $this->$localKey);
            }
        }

        public function hasMany($model , $foreignKey , $otherKey) {
            if($this->{$this->primaryKey}) {
                $className = "\\App\\Models\\" . $model;
                // print_r($className);
                // exit;
                $modelObject = new $className();
                // print_r($modelObject);
                // exit;
                return $modelObject->getHasManyRelation($this->table , $foreignKey , $otherKey , $this->$otherKey);
            }
        }

        public function blongsTo($model , $foreignKey , $localKey) {
            if($this->{$this->primaryKey}) {
                $className = "\\App\\Models\\" . $model;
                $modelObject = new $className();
                // print_r($modelObject);
                // exit;
                return $modelObject->getBlongsToRelation($this->table , $foreignKey , $localKey , $this->$foreignKey);
            }
        }
        protected function belongsToMany($model, $commonTable, $localKey, $middleForeignKey, $middleRelation, $foreignKey) {
            if ($this->{$this->primaryKey}) {
                $className = "\\App\\Models\\" . $model;
                $modelObject = new $className();
                
                return $modelObject->getBelongsToManyRelation(
                    $this->table,
                    $commonTable,
                    $localKey,
                    $this->{$localKey},
                    $middleForeignKey,
                    $middleRelation,
                    $foreignKey
                );
            }
        }
        
    
        protected function getBelongsToManyRelation($table, $commonTable, $localKey, $localKeyValue, $middleForeignKey, $middleRelation, $foreignKey) {
            // print_r(1);
            // exit;
            // $sql = "SELECT posts.* FROM ( SELECT category_post.* FROM categories JOIN category_post on categories.id = category_post.cat_id WHERE  categories.id = ? ) as relation JOIN posts on relation.post_id=posts.id ";
            $this->setSql("SELECT `c`.* FROM ( SELECT `b`.* FROM `{$table}` AS `a` JOIN `{$commonTable}` AS `b` on `a`.`{$localKey}` = `b`.`{$middleForeignKey}` WHERE  `a`.`{$localKey}` = ? ) AS `relation` JOIN ".$this->getTableName()." AS `c` ON `relation`.`{$middleRelation}` = `c`.`$foreignKey`");
            $this->addValue("{$table}_{$localKey}", $localKeyValue);
            $this->table = 'c';
            return $this;
                
        }
        
    }
?>