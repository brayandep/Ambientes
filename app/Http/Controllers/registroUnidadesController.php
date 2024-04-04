<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\Dependencia;
use Illuminate\Http\Request;

class registroUnidadesController extends Controller
{
    public function store(Request $request){
        
        $request -> validate([
            'nombreUnidad' => 'required|max:40|regex:/^[a-zA-Z\s]+$/|unique:unidades,nombreUnidad',
            'codigoUnidad' => 'required|digits:8|numeric|unique:unidades,codigoUnidad',
            'Responsable' => 'required|max:40|regex:/^[a-zA-Z\s]+$/',
            'Nivel' => 'required',
            'Dependencia' => 'required',
            'UnidadHabilitada'=> 'required'
        ]);
        
        $unidad = new Unidad();
        $unidad->nombreUnidad = $request->nombreUnidad;
        $unidad->codigoUnidad = $request->codigoUnidad;
        $unidad->Responsable = $request->Responsable;
        $unidad->Nivel = $request->Nivel;
        $unidad->Dependencia = $request->Dependencia;
        $unidad->UnidadHabilitada = $request->UnidadHabilitada;
        $unidad ->save();

        // Aquí asumimos que en el formulario se está enviando el 'id' de la unidad padre en el campo 'Dependencia'
        // También se debe verificar que cuando el nivel es 0, lo que significa que es la facultad, no debería tener una dependencia.
        
        if ($request->filled('Dependencia') && $request->Nivel > 0) {
            // Crear o actualizar la entrada en la tabla 'dependencias'
            $dependencia = new Dependencia;
            $dependencia->idunidadPadre = $request->Dependencia;
            $dependencia->idunidadHijo = $unidad->id;
            $dependencia->save();
        }
        
        return redirect()->route('visualizar_unidad');/* este es el codigo para redireccionar a otra vista desde controller*/
    }
    public function show(){
        $unidades = Unidad::orderBy('id', 'desc')->get();

        //$unidades = Unidad::all();

        return view('GestionUnidades.VisualizarUnidades', compact('unidades'));

    }
    public function edit(Unidad $unidad) {
        
        return view('GestionUnidades.EditarUnidades', compact('unidad'));
    }
    public function update(Request $request, Unidad $unidad){
        $unidad->nombreUnidad = $request ->nombreUnidad;
        $unidad->codigoUnidad = $unidad ->codigoUnidad;
        $unidad->Responsable = $request ->Responsable;
        $unidad->Nivel = $unidad->Nivel;
        $unidad->Dependencia =  $unidad ->Dependencia;
        $unidad->save();
        return redirect()->route('visualizar_unidad');
    }
    public function destroy(Unidad $unidad){
        $unidad->delete();
        return redirect()->route('visualizar_unidad');
        
    }
    public function updateEstado(Request $request, Unidad $unidad){
        $unidad->UnidadHabilitada = $request->input('Deshabilitado');
        $unidad->save();
        return redirect()->route('visualizar_unidad');
    }
    public function habilitarEstado(Request $request, Unidad $unidad){
        $unidad->UnidadHabilitada = $request->has('UnidadHabilitada') ? 1 : 0;
        $unidad->save();
        return back(); 
    }
    public function toggleEstado(Request $request, $unidadId){
        $unidad = Unidad::findOrFail($unidadId);
        $unidad->UnidadHabilitada = $request->has('UnidadHabilitada') ? 1 : 0;
        $unidad->save();

        return back(); // Redirige de vuelta a la página anterior
    }
}
