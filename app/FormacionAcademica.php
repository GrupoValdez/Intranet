<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormacionAcademica extends Model
{

    protected $table = 'formacion_acedemica';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'bachillerato', 'tecnico', 'superior', 'postgrado', 'diplomado', 'other_conocimiento', 'habilidades', 'id_usuario','created_at','updated_at'
    ];

}
