<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dowl extends Model
{
    protected $table = 'wp_dowl';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','wp_user_id','wp_post_id'];
    protected $guarded  = ['id'];
}
