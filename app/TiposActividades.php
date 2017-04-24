<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposActividades extends Model
{

    protected $table = 'tipos_actividades';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipo_actividad','created_at','updated_at'
    ];

}
