<?php

namespace App;

use App\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

class DatosPersonales extends Model
{
	use DatesTranslator;
    protected $table = 'datos_personales';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'last_name', 'apellidos', 'genero', 'estado_civil', 'direccion', 'departamento', 'municipio', 'correo_personal', 'cumpleanos', 'foto', 'mime', 'estado', 'bg_user', 'id_usuario','created_at','updated_at'
    ];

}
