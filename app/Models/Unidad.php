<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    protected $fillable = ['nombreUnidad','codigoUnidad','Responsable','Nivel','Dependencia'];
    protected $table = "unidades";

    public function unidadesHijas(){
        return $this->hasMany(Unidad::class, 'Dependencia', 'id');
    }
    public function unidadPadre(){
        return $this->belongsTo(Unidad::class, 'Dependencia', 'id');
    }

    /*public function unidadesHijas(){
        return $this->hasMany('App\Models\Unidad');
    }*/
}
