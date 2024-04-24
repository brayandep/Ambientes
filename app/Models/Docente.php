<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $guarded = [];

    //relacion uno a muchos
    function grupos(){
        return $this->hasMany('App\Models\Grupo', 'idDocente', 'id');
    }
}
