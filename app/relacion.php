<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class relacion extends Model
{
     protected $table = 'wp_term_relationships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['object_id','term_taxonomy_id','term_order'];
    protected $guarded  = ['object_id'];
}
