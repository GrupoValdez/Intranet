<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentariosSolicitudes extends Model
{

    protected $table = 'comentarios_solicitudes';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'conversation', 'documentos_adjuntos', 'id_detalle_solicitud', 'id_usuario','created_at','updated_at'
    ];

}
