<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialAdps extends Model
{

    protected $table = 'historial_adps_users';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fecha', 'id_adp', 'id_asistencias', 'id_usuario','created_at','updated_at'
    ];

}
