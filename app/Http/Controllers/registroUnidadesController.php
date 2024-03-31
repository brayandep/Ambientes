<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class registroUnidadesController extends Controller
{
    public function store(Request $request){
        
        $request -> validate([
            'nombreUnidad' => 'required|max:40|regex:/^[a-zA-Z\s]+$/|unique:unidads,nombreUnidad',
            'codigoUnidad' => 'required|digits:8|numeric|unique:unidads,codigoUnidad',
            'Responsable' => 'required|max:40|regex:/^[a-zA-Z\s]+$/',
            'Nivel' => 'required',
            'Dependencia' => 'required'
        ]);

        $unidad = new Unidad();
        $unidad->nombreUnidad = $request->nombreUnidad;
        $unidad->codigoUnidad = $request->codigoUnidad;
        $unidad->Responsable = $request->Responsable;
        $unidad->Nivel = $request->Nivel;
        $unidad->Dependencia = $request->Dependencia;
        $unidad ->save();
        
        return redirect()->route('visualizar_unidad');/* este es el codigo para redireccionar a otra vista desde controller*/
    }
    
}
