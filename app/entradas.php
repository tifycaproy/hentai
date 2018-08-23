<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entradas extends Model
{
     protected $table = 'wp_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','post_date','post_title','post_status'];
    protected $guarded  = ['term_id'];
}
