<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class Evento extends Model
{
    use HasFactory;
    protected $guarded = [];

    //////////////////////////////registro en el log///////////////////////
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($evento) {
            // Registro de creación en la bitácora
            Log::create([
                'event_type' => 'Evento creado',
                'user_id' => Auth::id(),
                'new_data' => json_encode(['evento_id' => $evento->id]),
                'tabla_afectada' => 'eventos',
                'id_afectado' => $evento->id,
            ]);
        });
    
        static::updated(function ($evento) {
            // Obtener los datos antiguos y nuevos
            $oldData = $evento->getOriginal();
            $newData = $evento->toArray();
        
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
                'event_type' => 'Evento editado',
                'user_id' => Auth::id(),
                'old_data' => json_encode($oldFields),
                //'new_data' => json_encode($changedFields),
                'tabla_afectada' => 'eventos',
                'id_afectado' => $evento->id,
            ]);
        });
    
        static::deleted(function ($evento) {
            // Registro de eliminación en la bitácora
            Log::create([
                'event_type' => 'Evento eliminado',
                'user_id' => Auth::id(),
                'old_data' => json_encode($evento->toArray()),
                'tabla_afectada' => 'eventos',
                'id_afectado' => $evento->id,
            ]);
        });
    }
}
