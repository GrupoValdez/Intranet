<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{

    protected $table = 'marcas';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'marca','created_at','updated_at'
    ];

}
