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
        protected function belongsToMany($model, $pivotTable, $localKey, $pivotLocalKey, $pivotForeignKey, $foreignKey)
        {
            // اگر مدل وجود نداشته باشه
            if (!$this->exists || empty($this->{$localKey})) {
                return [];
            }

            // پاک کردن کوئری‌های قبلی
            $this->removeQuery();

            // ساخت مدل مقصد
            $relatedClass = "\\App\\Models\\{$model}";
            $related = new $relatedClass();

            $currentTable = $this->getTableName(); // مثلاً `roles`
            $relatedTable = $related->getTableName(); // مثلاً `users`

            // ساخت SQL
            $sql = "
                SELECT {$related->getAttributeName('*')}
                FROM {$currentTable}
                INNER JOIN `{$pivotTable}` ON {$this->getAttributeName($localKey)} = `{$pivotTable}`.`{$pivotLocalKey}`
                INNER JOIN {$relatedTable} ON `{$pivotTable}`.`{$pivotForeignKey}` = {$related->getAttributeName($foreignKey)}
                WHERE {$this->getAttributeName($localKey)} = ?
            ";

            $this->setSql($sql);
            $this->addValue("{$currentTable}_{$localKey}", $this->{$localKey});

            // اجرای کوئری
            $statement = $this->executeQuery();

            $results = [];
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $instance = clone $related;
                $instance->fill($row);
                $instance->exists = true;
                $instance->table = $related->table; // مهم: جدول درست باشه
                $results[] = $instance;
            }

            // پاک کردن برای کوئری بعدی
            $this->removeQuery();

            return $results;
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
                return $this->arrayToAttributs($data);
            }            
            return NULL;        
        }

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