<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_Ambiente_id',
        'codigo',
        'unidad',
        'nombre',
        'capacidad',
        'ubicacion',
        'descripcion_ubicacion',
        'estadoAmbiente',
    ];
}
