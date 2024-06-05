<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'nombre',
        'email',
        'password',
        'ci',
        'direccion',
        'telefono',
        'rol',
        // Nombre del campo de contraseña personalizado
    ];

    protected $hidden = [
        'password', // Nombre del campo de contraseña personalizado
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
    
    function grupos(){
        return $this->hasMany('App\Models\Grupo', 'idDocente', 'id');
    }
 //////////////////////////////registro en el log///////////////////////
 protected static function boot()
 {
     parent::boot();
 
     static::created(function ($user) {
         // Registro de creación en la bitácora
         Log::create([
             'event_type' => 'Usuario creado',
             'user_id' => Auth::id(),
             'new_data' => json_encode(['user_id' => $user->id]),
             'tabla_afectada' => 'users',
             'id_afectado' => $user->id,
         ]);
     });
 
     static::updated(function ($user) {
         // Obtener los datos antiguos y nuevos
         $oldData = $user->getOriginal();
         $newData = $user->toArray();
     
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
             'event_type' => 'Usuario editado',
             'user_id' => Auth::id(),
             'old_data' => json_encode($oldFields),
             //'new_data' => json_encode($changedFields),
             'tabla_afectada' => 'users',
             'id_afectado' => $user->id,
         ]);
     });
 
     static::deleted(function ($user) {
         // Registro de eliminación en la bitácora
         Log::create([
             'event_type' => 'Usuario eliminado',
             'user_id' => Auth::id(),
             'old_data' => json_encode($user->toArray()),
             'tabla_afectada' => 'users',
             'id_afectado' => $user->id,
         ]);
     });
 }
}
