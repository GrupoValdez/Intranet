<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{

    protected $table = 'documentos';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre_archivo','mime','type_upload' ,'ubicacion_anterior', 'ubicacion_archivo','created_at','updated_at'
    ];

}
