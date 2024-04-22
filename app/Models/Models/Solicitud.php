<?php

namespace App\Models\Models;

use App\Models\HorarioDisponible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $primaryKey = 'idsolicitud';
    protected $table = 'solicitud';
    protected $fillable = [ 'usuario' ,
    'fecha',
    'motivo' ,
    'materia' ,
    'grupo',
    'nro_aula',
    'horario' ,
    'estado',]; // Asegúrate de agregar los campos necesarios

    // Si la relación entre la solicitud y el usuario existe, puedes definirla aquí
    public function horario(){
        return $this->belongsTo(HorarioDisponible::class);
    }
}