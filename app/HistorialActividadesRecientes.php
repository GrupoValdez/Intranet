<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialActividadesRecientes extends Model
{

    protected $table = 'historial_actividades_recientes';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_usuario', 'nonbre_user', 'tipo_actividad', 'id_post', 'id_users_view', 'descripcion_actividad', 'id_event_calendar','created_at','updated_at'
    ];

}
