<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncargadosAreas extends Model
{

    protected $table = 'encargados_area';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_encargardo', 'area','created_at','updated_at'
    ];

}
