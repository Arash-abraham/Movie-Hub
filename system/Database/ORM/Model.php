<?php

    namespace System\Database\ORM;

    use System\Database\Traits\HasAttributes;
    use System\Database\Traits\HasCRUD;
    use System\Database\Traits\HasMethodCaller;
    use System\Database\Traits\HasQueryBuilder;
    use System\Database\Traits\HasRelation;

    abstract class Model
    {
        use HasAttributes, HasCRUD, HasQueryBuilder, HasMethodCaller, HasRelation;

        protected $table;
        public $exists = false;
        protected $fillable = [];
        protected $hidden = [];
        protected $casts = [];
        protected $primaryKey = "id";
        protected $guarded = [];
        protected $createdAt = 'created_at';
        protected $updatedAt = 'updated_at';
        protected $deletedAt = 'deleted_at';  // فعال
        // protected $deletedAt = null;       // غیرفعال
        protected $collection = [];
    }
?>