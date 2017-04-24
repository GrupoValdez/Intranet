<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionesEventos extends Model
{

    protected $table = 'notificaciones_eventos';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'titulo_evento', 'descripcion_evento', 'color_evento', 'img_notify','created_at','updated_at'
    ];

}
