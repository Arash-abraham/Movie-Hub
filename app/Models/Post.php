<?php 

    namespace App\Models;

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

        public function category() {
            return $this->belongsTo("Category","cat_id","id");
        }
    }
?>