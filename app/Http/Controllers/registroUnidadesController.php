<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class registroUnidadesController extends Controller
{
    public function store(Request $request){
        $unidad = new Unidad();
        $unidad->nombreUnidad = $request->nombreUnidad;
        $unidad->codigoUnidad = $request->codigoUnidad;
        $unidad->Responsable = $request->Responsable;
        $unidad->Nivel = $request->Nivel;
        $unidad->Dependencia = $request->Dependencia;
        $unidad ->save();
        return redirect()->route('visualizar_unidad');
    }
}
