<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{

    protected $table = 'horarios';    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'bloq_horario1', 'bloq_horario1Time', 'bloq_horario2', 'bloq_horario2Time', 'bloq_horario3', 'bloq_horario3Time', 'bloq_horarioMedio1', 'bloq_horarioMedio1Time', 'bloq_horarioMedio2', 'bloq_horarioMedio2Time', 'bloq_horarioMedio3', 'bloq_horarioMedio3Time', 'id_usuario','created_at','updated_at'
    ];

}
