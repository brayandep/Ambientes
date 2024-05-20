<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = 'publicaciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'titulo', 'descripcion', 'archivo', 'fecha_vencimiento','tipo', 'visible'
    ];
}
