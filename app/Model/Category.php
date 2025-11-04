<?php 

    namespace App;

    use System\Database\ORM\Model;
    
    class Category extends Model {
        protected $table = "categories";
        protected $fillable = [
            "name"
        ];
        protected $guarded = ["id"];
        protected $casts = [];

        public function posts() {
            $this->hasMany("Post","cat_id","id");
        }
    }
?>