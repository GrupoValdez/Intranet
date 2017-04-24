<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetOnline extends Model
{

    protected $table = 'get_users_online';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_user_login','created_at','updated_at'
    ];

}
