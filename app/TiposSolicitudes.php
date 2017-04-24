<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposSolicitudes extends Model
{

    protected $table = 'tipos_solicitudes';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipo_solicitud','created_at','updated_at'
    ];

}
