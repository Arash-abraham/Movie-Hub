<?php 

    namespace App;

    use System\Database\ORM\Model;
    
    class Role extends Model {
        protected $table = "roles";
        protected $fillable = [
            "name"
        ];
        protected $guarded = ["id"];
        protected $casts = [];
    }
?>