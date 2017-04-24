<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordatoriosAdmin extends Model
{

    protected $table = 'recordatorios_admin';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion_recordatorio', 'id_usuario','created_at','updated_at'
    ];

}
