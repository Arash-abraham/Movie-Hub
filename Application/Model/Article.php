<?php
    namespace Application\Model;

    class Article extends Model {
        public function all() {
            $Query = 'SELECT * FROM `articles`;';
            $result = $this->Query($Query)->fetchAll(); 
            return $result;
        } 
        public function find($id) {
            if (!is_numeric($id) || $id <= 0) {
                return null;
            }
            $Query = "SELECT * , 
            (SELECT name FROM categories
            WHERE categories.id = articles.cat_id)
            AS category FROM articles WHERE id = ?;";
            $result = $this->Query($Query  , array($id))->fetch(); 
            return $result;
        }
        public function insert($values) {
            $maxIdSql = "SELECT MAX(`id`) AS max_id FROM articles";
            $result = $this->Query($maxIdSql)->fetch(); 
            $newId = $result['max_id'] + 1;
            $Query = "INSERT INTO 
            `articles` (`id` , `title` , `cat_id` , `body` , `created_at`) 
            VALUES (? , ? , ? , ? , NOW());";
            $this->Execute($Query, array_merge([$newId], array_values($values)));
        }
        public function update($values) {
            $Query = "UPDATE `articles` SET `title` = ? , `cat_id` = ? , `body` = ?, `updated_at` = NOW() WHERE `id` = ?;";
            $this->Execute($Query , array_values($values));
        }
        public function delete($id) {
            if (!is_numeric($id) || $id <= 0) {
                return null;
            }
            $Query = "DELETE FROM `articles` WHERE `id` = ?;";
            $this->Execute($Query , array($id));
        }
    }
?>
