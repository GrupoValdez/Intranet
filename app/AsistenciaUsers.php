<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsistenciaUsers extends Model
{

    protected $table = 'asistencia_usuarios';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'hora_entrada', 'hora_salida', 'fecha', 'id_usuario','created_at','updated_at'
    ];

}
