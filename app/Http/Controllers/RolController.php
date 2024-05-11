<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index(){
        return view ('RegistroRol.Registrar_roles_nuevos');
    }
    public function store(Request $request){
        $request -> validate([
            'nombreRol' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'descripcionRol' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'tipoVigencia' => 'required',
            'fechaInicioRol' => 'required'
        ]);
        $rol = new Rol();
        $rol -> Estado = $request -> Estado;
        $rol -> nombreRol = $request -> nommbreRol;
        $rol -> descripcionRol = $request -> descripcionRol;
        $rol -> tipoVigencia = $request -> tipoVigencia;
        $rol -> fechaInicioRol = $request ->fechaInicioRol;
        $rol -> fechaFinRol = $request -> fechaFinRol;
        $rol -> save();
        
    }

}
