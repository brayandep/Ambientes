<?php

namespace App\Http\Controllers;
use App\Models\Unidad;

use Illuminate\Http\Request;

class DependenciaUnidadController extends Controller
{
    //
    public function buscar($nivel){
       
         // Asume que el nivel 1 depende de unidades de nivel 0
        $nivelPadre = $nivel - 1;

        // Obtiene las unidades que son padres de este nivel
        $unidadesPadre = Unidad::where('Nivel', $nivelPadre)->get();

        return response()->json($unidadesPadre);
    }
}
