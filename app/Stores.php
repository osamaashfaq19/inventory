<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class Stores extends Model
    {
        protected $table = 'stores';
        protected $primaryKey = 'store_id';
        public $timestamps = false;
        const CREATED_AT = 'date_added';
        const UPDATED_AT = 'date_modified';
    }
