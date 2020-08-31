<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class OrderDetails extends Model
    {
        protected $table = 'order_details';
        protected $primaryKey = 'order_detail_id';
        public $timestamps = false;
        const CREATED_AT = 'date_added';
        const UPDATED_AT = 'date_modified';
    }
