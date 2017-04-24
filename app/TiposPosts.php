<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposPosts extends Model
{

    protected $table = 'tipo_posts';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipos_post','created_at','updated_at'
    ];

}
