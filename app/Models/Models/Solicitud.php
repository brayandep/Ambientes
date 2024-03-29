<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $fillable = ['motivo', 'id_usuario', 'fecha']; // Asegúrate de agregar los campos necesarios

    // Si la relación entre la solicitud y el usuario existe, puedes definirla aquí
    
}
