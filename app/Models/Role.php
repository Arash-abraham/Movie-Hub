<?php 

    namespace App\Models;

    use System\Database\ORM\Model;
    
    class Role extends Model {
        protected $table = "roles";
        protected $fillable = [
            "name"
        ];
        protected $guarded = ["id"];
        protected $casts = [];

        public function users() {
            return $this->belongsToMany("User","user_role","id","role_id","user_id","id"); // First id for role , Second id for user
        }
    }
?>