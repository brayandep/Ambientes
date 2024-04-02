<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambiente; // Asegúrate de importar el modelo Ambiente si aún no lo has hecho

class buscadorController extends Controller
{
    public function __invoke()
    {
        return view('buscador');
    }

    public function buscarAmbientes(Request $request)
    {
        // Aquí se procesa la búsqueda de ambientes
        // Puedes utilizar los datos de búsqueda que vienen en el objeto $request

        // Por ahora, simplemente retornamos un mensaje para probar
        return "Procesando búsqueda de ambientes...";
    }
}

