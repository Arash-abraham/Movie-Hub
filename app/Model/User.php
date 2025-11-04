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
            return $this->belongsToMany();
        }
    }
?>