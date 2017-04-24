<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{

    protected $table = 'sucursales';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sucursal', 'geocalizacion', 'id_marca','created_at','updated_at'
    ];

}
