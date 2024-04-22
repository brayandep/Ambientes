<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Usuario;
class RegistroController extends Controller

{
    //
    public function create()
    {
        return view('registro');
    }

    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contraseña' => 'required|string|min:6',
        ]);

        // Crear el usuario
        $Usuario = new usuario();
        $Usuario->nombre = $request['nombre'];
        $Usuario->contraseña = $request['contraseña'];
        $Usuario->save();


        // Redireccionar a alguna página
        return redirect()->route('registro')->with('registro_exitoso', true);
    }
}
