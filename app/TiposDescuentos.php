<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposDescuentos extends Model
{

    protected $table = 'tipos_descuentos';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'vacaciones', 'dia_septimo', 'sin_descuento', 'id_usuario', 'id_detalles_solicitud','created_at','updated_at'
    ];

}
