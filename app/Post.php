<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'imagen', 'documentos', 'mime', 'id_tipo_publicacion', 'id_tipo_evento', 'id_usuario','created_at','updated_at'
    ];

}
