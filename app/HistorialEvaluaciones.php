<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialEvaluaciones extends Model
{

    protected $table = 'historial_evaluaciones';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'orden_limpieza_trabajo', 'trabajo_en_equipo', 'cumplimiento_tiempos_entrega', 'proactividad', 'actitud_antes_estres_dificultades', 'puntualidad_entrada_salida', 'evaluacion_desempeno', 'conocimientos_necesarios', 'imagen_higiene_personal', 'lenguaje_verbal', 'total', 'evaluacion_realizada', 'mes_evaluacion', 'proxima_evaluacion', 'id_usuario', 'id_encargado','created_at','updated_at'
    ];

}
