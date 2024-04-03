<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Materia extends Model
{
    use HasFactory;
    protected $table = "materia";

    public function getNombreAttribute($value){
        return ucwords($value);
    }
    public function setNombreAttribute($value){
        $this->attributes['nombre'] = strtolower($value);
    }

    public function getDepartamentoAttribute($value){
        return ucwords($value);
    }
    public function setDepartamentoAttribute($value){
        $this->attributes['departamento'] = strtolower($value);
    }

    public function getCarreraAttribute($value){
        return ucwords($value);
    }
    public function setCarreraAttribute($value){
        $this->attributes['carrera'] = strtolower($value);
    }
}

