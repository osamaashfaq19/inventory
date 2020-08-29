<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class Users extends Model
    {
        protected $table = 'users';
        protected $primaryKey = 'user_id';
        public $timestamps = false;
        const CREATED_AT = 'date_added';
        const UPDATED_AT = 'date_modified';
    }
