<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class Ambiente extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_Ambiente_id',
        'codigo',
        'unidad',
        'nombre',
        'capacidad',
        'ubicacion',
        'descripcion_ubicacion',
        'estadoAmbiente',
    ];
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($ambiente) {
            // Registro de creación en la bitácora
            Log::create([
                'event_type' => 'Ambiente creado',
                'user_id' => Auth::id(),
                'new_data' => json_encode(['ambientes_id' => $ambiente->id]),
                'tabla_afectada' => 'ambientes',
                'id_afectado' => $ambiente->id,
            ]);
        });
    
        static::updated(function ($ambiente) {
            // Obtener los datos antiguos y nuevos
            $oldData = $ambiente->getOriginal();
            $newData = $ambiente->toArray();
        
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
                'event_type' => 'Ambiente editado',
                'user_id' => Auth::id(),
                'old_data' => json_encode($oldFields),
                //'new_data' => json_encode($changedFields),
                'tabla_afectada' => 'ambientes',
                'id_afectado' => $ambiente->id,
            ]);
        });
    
        static::deleted(function ($ambiente) {
            // Registro de eliminación en la bitácora
            Log::create([
                'event_type' => 'Ambiente eliminado',
                'user_id' => Auth::id(),
                'old_data' => json_encode($ambiente->toArray()),
                'tabla_afectada' => 'ambientes',
                'id_afectado' => $ambiente->id,
            ]);
        });
    }
    
  
}