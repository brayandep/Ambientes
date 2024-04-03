<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    use HasFactory;
    protected $table = "dependencias";
    public function unidadPadre(){
        return $this->belongsTo('App\Models\Unidad');
    }
}
