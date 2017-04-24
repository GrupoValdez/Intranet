<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikesPosts extends Model
{

    protected $table = 'likes_posts';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_publicacion', 'id_usuarios_likes', 'total_likes','created_at','updated_at'
    ];

}
