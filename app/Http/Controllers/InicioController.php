<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class InicioController extends Controller
{
    public function mostrarInicio()
    {
        // Obtener las publicaciones necesarias
        $publicaciones = Publicacion::all(); // Esto es solo un ejemplo, podrías necesitar una consulta más específica

        // Pasar las publicaciones a la vista de inicio
        return view('inicio', ['publicaciones' => $publicaciones]);
    }
    public function mostrarInicio2()
    {
        // Obtener las publicaciones necesarias
        $publicaciones = Publicacion::all(); // Esto es solo un ejemplo, podrías necesitar una consulta más específica

        // Pasar las publicaciones a la vista de inicio
        return view('invitado', ['publicaciones' => $publicaciones]);
    }
}
