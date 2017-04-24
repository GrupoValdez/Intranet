<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostPersonalizados extends Model
{

    protected $table = 'post_personalizados';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_posts', 'id_usuario','created_at','updated_at'
    ];

}
