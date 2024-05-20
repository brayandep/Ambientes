<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
}
