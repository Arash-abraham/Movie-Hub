<?php
    namespace Application\Model;

    class Category extends Model {
        public function all() {
            $Query = 'SELECT * FROM `categories`;';
            $result = $this->Query($Query)->fetchAll(); 
            return $result;
        }
        public function articles($cat_id) {
            $Query = 'SELECT * FROM `articles` WHERE `cat_id` = ?;';
            $result = $this->Query($Query , array($cat_id))->fetchAll(); 
            return $result;
        }
        public function find($id) {
            $Query = 'SELECT * FROM `categories` WHERE `id` = ?;';
            $result = $this->Query($Query , array($id))->fetch(); 
            return $result;
        }
        public function insert($values) {
            $maxIdSql = "SELECT MAX(`id`) AS max_id FROM categories";
            $result = $this->Query($maxIdSql)->fetch(); 
            $newId = $result['max_id'] + 1;
        
            if (count($values) !== 2) {
                print "Expected two values for name and description.";
            }
        
            $Query = "INSERT INTO `categories`
            (`id`, `name`, `description`, `created_at`) 
            VALUES (?, ?, ?, NOW());";
            $this->Execute($Query, array_merge([$newId], array_values($values)));
        } 
        public function update($values) {
            $Query = "UPDATE `categories` SET `name` = ? , `description` = ? , `updated_at` = NOW() WHERE `id` = ?;";
            $this->Execute($Query, array_values($values));
        }
        public function delete($id) {
            $Query = "DELETE FROM `categories` WHERE `id` = ?;";
            $this->Execute($Query , array($id));
        }
    }
?>
