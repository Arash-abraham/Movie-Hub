<?php

    namespace System\Database\ORM;

    use System\Database\Traits\HasAttributes;
    use System\Database\Traits\HasCRUD;
    use System\Database\Traits\HasMethodCaller;
    use System\Database\Traits\HasQueryBuilder;
    use System\Database\Traits\HasRelation;
    use System\Database\Traits\HasSoftDelete; 

    abstract class Model {
        use HasAttributes, HasCrud, HasQueryBuilder, HasMethodCaller , HasRelation, HasSoftDelete;
        
        protected $table;
        protected $fillable = [];
        protected $hidden = [];
        protected $casts = [];
        protected $primaryKey = "id";
        protected $guarded = [];
        protected $createdAt = 'created_at';
        protected $updatedAt = 'updated_at';
        protected $deletedAt = NULL;
        protected $collection = [];
    }
?>