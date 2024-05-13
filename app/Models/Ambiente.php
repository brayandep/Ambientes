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
                //'user_id' => Auth::id(),
                'new_data' => json_encode($ambiente->toArray()),
                'operation' => 'Crear',
            ]);
        });

        static::updated(function ($ambiente) {
            // Registro de edición en la bitácora
            Log::create([
                'event_type' => 'Ambiente editado',
                //'user_id' => Auth::id(),
                'old_data' => json_encode($ambiente->getOriginal()),
                'new_data' => json_encode($ambiente->toArray()),
                'operation' => 'Editar',
            ]);
        });

        static::deleted(function ($ambiente) {
            // Registro de eliminación en la bitácora
            Log::create([
                'event_type' => 'Ambiente eliminado',
                //'user_id' => Auth::id(),
                'old_data' => json_encode($ambiente->toArray()),
                'operation' => 'Eliminar',
            ]);
        });
    }
}
