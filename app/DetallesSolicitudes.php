<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class DetallesSolicitudes extends Model
{
	use DatesTranslator;
    protected $table = 'detalles_solicitudes';    


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'motivo_descripcion', 'fecha_permiso', 'hora_permiso', 'solicitud_aceptada', 'solicitud_denegada', 'solicitud_espera', 'documentos_adjunto', 'img_adjunta', 'solicitud_vista', 'solicitud_compartida', 'id_usuario', 'id_tipo_solicitud','created_at','updated_at'
    ];

}
