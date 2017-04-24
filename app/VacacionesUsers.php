<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacacionesUsers extends Model
{

    protected $table = 'vacaciones_user';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'dias', 'fecha_vacaciones', 'id_usuario','created_at','updated_at'
    ];

}
