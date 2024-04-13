<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    public function inipubli()
    {
        // Recuperar todas las publicaciones de la base de datos
        $publicaciones = Publicacion::all();
        
        // Pasar los datos a la vista
        return view('Inicio', ['publicaciones' => $publicaciones]);
    }
}
