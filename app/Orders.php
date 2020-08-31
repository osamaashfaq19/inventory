<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class Orders extends Model
    {
        protected $table = 'orders';
        protected $primaryKey = 'order_id';
        public $timestamps = false;
        const CREATED_AT = 'date_added';
        const UPDATED_AT = 'date_modified';
    }
