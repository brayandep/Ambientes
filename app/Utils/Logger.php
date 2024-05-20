<?php

namespace App\Utils;
use App\Models\Log;

class Logger
{
    public static function logCreation($eventType, $newData)
    {
        Log::create([
            'event_type' => $eventType,
            //'user_id' => auth()->id(), // Opcional: Obtener el ID del usuario autenticado
            'new_data' => json_encode($newData),
            'operation' => 'Crear',
        ]);
    }

    public static function logUpdate($eventType, $oldData, $newData)
    {
        Log::create([
            'event_type' => $eventType,
            //'user_id' => auth()->id(), // Opcional: Obtener el ID del usuario autenticado
            'old_data' => json_encode($oldData),
            'new_data' => json_encode($newData),
            'operation' => 'Editar',
        ]);
    }

    public static function logDeletion($eventType, $oldData)
    {
        Log::create([
            'event_type' => $eventType,
            //'user_id' => auth()->id(), // Opcional: Obtener el ID del usuario autenticado
            'old_data' => json_encode($oldData),
            'operation' => 'Eliminar',
        ]);
    }
}
