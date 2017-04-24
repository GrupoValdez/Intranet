<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosEmpleados extends Model
{

    protected $table = 'datos_empleados';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'area_departamento', 'cargo', 'jefe_inmediato', 'correo_corporativo', 'celular', 'extencion', 'fecha_ingreso', 'id_marca', 'id_sucursal', 'id_usuario','created_at','updated_at'
    ];

}
