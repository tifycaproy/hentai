<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
        protected $table = 'wp_user_app';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','email','pin'];
    protected $guarded  = ['id'];
}
