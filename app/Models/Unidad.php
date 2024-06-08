<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class Unidad extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombreUnidad', 'codigoUnidad', 'Responsable', 'Nivel', 'Dependencia'];
    protected $table = "unidades";

    public function unidadesHijas(){
        return $this->hasMany(Unidad::class, 'Dependencia', 'id');
    }

    public function unidadPadre(){
        return $this->belongsTo(Unidad::class, 'Dependencia', 'id');
    }

    protected static function boot()
{
    parent::boot();

    static::created(function ($unidad) {
        // Registro de creación en la bitácora
        Log::create([
            'event_type' => 'Unidad creada',
            'user_id' => Auth::id(),
            'new_data' => json_encode(['unidad_id' => $unidad->id]),
            'tabla_afectada' => 'unidades',
            'id_afectado' => $unidad->id,
        ]);
    });

    static::updated(function ($unidad) {
        $oldData = $unidad->getOriginal();
        $newData = $unidad->toArray();

        // Inicializar arrays para almacenar los campos que han cambiado
        $changedFields = [];
        $oldFields = [];

        // Definir los campos a excluir
        $excludedFields = ['created_at', 'updated_at'];

        // Comparar los datos antiguos con los nuevos, excluyendo los campos especificados
        foreach ($newData as $key => $value) {
            if (!in_array($key, $excludedFields)) {
                if (array_key_exists($key, $oldData) && $value !== $oldData[$key]) {
                    // Almacenar los campos que han cambiado
                    $changedFields[$key] = $value;
                    $oldFields[$key] = $oldData[$key];
                }
            }
        }

        // Registro de edición en la bitácora
        Log::create([
            'event_type' => 'Unidad editada',
            'user_id' => Auth::id(),
            'old_data' => json_encode($oldFields),
            //'new_data' => json_encode($changedFields),
            'tabla_afectada' => 'unidades',
            'id_afectado' => $unidad->id,
        ]);
    });

    static::deleted(function ($unidad) {
        // Registro de eliminación en la bitácora
        Log::create([
            'event_type' => 'Unidad eliminada',
            //'user_id' => Auth::id(),
            'old_data' => json_encode($unidad->toArray()),
            'tabla_afectada' => 'unidades',
            'id_afectado' => $unidad->id,
        ]);
    });
}

}
