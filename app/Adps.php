<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adps extends Model
{

    protected $table = 'adps';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipo_adp', 'value_adp','created_at','updated_at'
    ];

}
