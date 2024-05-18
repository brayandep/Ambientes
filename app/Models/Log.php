<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'user_id',
        'old_data',
        'new_data',
        'tabla_afectada',
        'id_afectado',
    ];

    // Relación con el modelo de usuario si es necesario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
