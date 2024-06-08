<?php

namespace App\Models\Models;

use App\Models\HorarioDisponible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class Solicitud extends Model
{
    use HasFactory;
    protected $primaryKey = 'idsolicitud';
    protected $table = 'solicitud';
    protected $fillable = [
        'usuario',
        'fecha',
        'motivo',
        'materia',
        'grupo',
        'nro_aula',
        'horario',
        'nombre',
        'estado',
    ]; // Asegúrate de agregar los campos necesarios

    // Relación con el modelo HorarioDisponible
    public function horario(){
        return $this->belongsTo(HorarioDisponible::class);
    }

    //////////////////////////////registro en el log///////////////////////
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($solicitud) {
            // Registro de creación en la bitácora
            Log::create([
                'event_type' => 'Solicitud creada',
                'user_id' => Auth::id(),
                'new_data' => json_encode(['solicitud_id' => $solicitud->idsolicitud]),
                'tabla_afectada' => 'solicitud',
                'id_afectado' => $solicitud->idsolicitud,
            ]);
        });
    
        static::updated(function ($solicitud) {
            // Obtener los datos antiguos y nuevos
            $oldData = $solicitud->getOriginal();
            $newData = $solicitud->toArray();
        
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
                'event_type' => 'Solicitud editada',
                'user_id' => Auth::id(),
                'old_data' => json_encode($oldFields),
                //'new_data' => json_encode($changedFields),
                'tabla_afectada' => 'solicitud',
                'id_afectado' => $solicitud->idsolicitud,
            ]);
        });
    
        static::deleted(function ($solicitud) {
            // Registro de eliminación en la bitácora
            Log::create([
                'event_type' => 'Solicitud eliminada',
                'user_id' => Auth::id(),
                'old_data' => json_encode($solicitud->toArray()),
                'tabla_afectada' => 'solicitud',
                'id_afectado' => $solicitud->idsolicitud,
            ]);
        });
    }
}
