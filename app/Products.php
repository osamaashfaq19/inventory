<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class Products extends Model
    {
        protected $table = 'products';
        protected $primaryKey = 'product_id';
        public $timestamps = false;
        const CREATED_AT = 'date_added';
        const UPDATED_AT = 'date_modified';
    }
