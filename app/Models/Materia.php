<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

class Materia extends Model
{
    use HasFactory;
    protected $table = "materia";

    // protected $fillable = ['departamento','carrera','nombre','codigo','nivel', 'cantGrupo'];
    protected $guarded = [];

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

    //relacion uno a muchos
    function grupos(){
        return $this->hasMany('App\Models\Grupo', 'idMateria', 'id');
    }
    //////////////////////////////registro en el log///////////////////////
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($materia) {
            // Registro de creación en la bitácora
            Log::create([
                'event_type' => 'Materia creada',
                'user_id' => Auth::id(),
                'new_data' => json_encode(['materia_id' => $materia->id]),
                'tabla_afectada' => 'materia',
                'id_afectado' => $materia->id,
            ]);
        });
    
        static::updated(function ($materia) {
            // Obtener los datos antiguos y nuevos
            $oldData = $materia->getOriginal();
            $newData = $materia->toArray();
        
            // Inicializar arrays para almacenar los campos que han cambiado
            $changedFields = [];
            $oldFields = [];
        
            // Definir los campos a excluir
            $excludedFields = ['created_at', 'updated_at'];
        
            // Comparar los datos antiguos con los nuevos, excluyendo los campos especificados
            foreach ($newData as $key => $value) {
                if (!in_array($key, $excludedFields) && $value !== $oldData[$key]) {
                    // Almacenar los campos que han cambiado
                    $changedFields[$key] = $value;
                    $oldFields[$key] = $oldData[$key];
                }
            }
        
            // Registro de edición en la bitácora
            Log::create([
                'event_type' => 'Materia editada',
                'user_id' => Auth::id(),
                'old_data' => json_encode($oldFields),
               // 'new_data' => json_encode($changedFields),
                'tabla_afectada' => 'materia',
                'id_afectado' => $materia->id,
            ]);
        });
    
        static::deleted(function ($materia) {
            // Registro de eliminación en la bitácora
            Log::create([
                'event_type' => 'Materia eliminada',
                'user_id' => Auth::id(),
                'old_data' => json_encode($materia->toArray()),
                'tabla_afectada' => 'materia',
                'id_afectado' => $materia->id,
            ]);
        });
    }
}