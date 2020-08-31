<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class Stock extends Model
    {
        protected $table = 'stock_management';
        protected $primaryKey = 'stock_id';
        public $timestamps = false;
        const CREATED_AT = 'date_added';
        const UPDATED_AT = 'date_modified';
    }
