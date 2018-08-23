<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
     protected $table = 'wp_terms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['term_id','name','slug','term_group'];
    protected $guarded  = ['term_id'];
}
