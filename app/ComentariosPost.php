<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentariosPost extends Model
{

    protected $table = 'comentarios_post';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'comentarios', 'id_publicacion', 'id_usuario','created_at','updated_at'
    ];

}
