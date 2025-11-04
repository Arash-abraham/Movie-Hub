<?php 

    namespace App;

    use System\Database\ORM\Model;
    
    class User extends Model {
        protected $table = "users";
        protected $fillable = [
            "username"
        ];
        protected $guarded = ["id"];
        protected $casts = [];

        public function roles() {
            return $this->belongsToMany("Role","user_role","id","user_id","role_id","id"); // First id for user , Second id for role
        }
    }
?>