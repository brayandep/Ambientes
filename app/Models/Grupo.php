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
}
