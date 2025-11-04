<?php 

    namespace App;

    use System\Database\ORM\Model;
    
    class Post extends Model {
        protected $table = "posts";
        protected $fillable = [
            "title",
            "body",
            "cat_id"
        ];
        protected $guarded = ["id"];
        protected $casts = [];

        public function posts() {
            
        }
    }
?>