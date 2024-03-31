<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitud';
    protected $fillable = [ 'usuario' ,
    'fecha',
    'motivo' ,
    'materia' ,
    'grupo',
    'nro_aula',
    'horario' ,]; // Asegúrate de agregar los campos necesarios

    // Si la relación entre la solicitud y el usuario existe, puedes definirla aquí
    
}
