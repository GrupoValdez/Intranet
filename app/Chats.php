<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{

    protected $table = 'chats_users';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'conversations', 'visto_mensage' ,'file','mime', 'id_user', 'id_user_conversation','created_at','updated_at'
    ];

}
