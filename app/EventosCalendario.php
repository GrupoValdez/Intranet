<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventosCalendario extends Model
{

    protected $table = 'eventos_calendario';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion_evento', 'fecha_evento', 'id_usuario','created_at','updated_at'
    ];

}
