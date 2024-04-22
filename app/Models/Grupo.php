<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getDocenteAttribute($value){
        return ucwords($value);
    }
    public function setDocenteAttribute($value){
        $this->attributes['docente'] = strtolower($value);
    }

    //relacion uno a muchos (inversa)
    public function eldocente()
    {
        return $this->belongsTo('App\Models\Docente', 'idDocente', 'id');
    }
    public function materia()
    {
        return $this->belongsTo('App\Models\Materia', 'idMateria', 'id');
    }
}
