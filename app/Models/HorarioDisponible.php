<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioDisponible extends Model
{
    use HasFactory;
    protected $fillable = [
        'ambiente_id',
        'horaInicio',
        'horaFin',
        'estadoHorario',
        'dia',
    ];

}
