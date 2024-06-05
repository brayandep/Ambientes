<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\Dependencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PDF;

class registroUnidadesController extends Controller
{
    public function store(Request $request){
        
        $request -> validate([
            'nombreUnidad' => 'required|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s.]+$/|unique:unidades,nombreUnidad',
            // 'codigoUnidad' => 'required|digits:6|numeric|unique:unidades,codigoUnidad',
            'Responsable' => 'required|max:40|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s.]+$/',
            'Nivel' => 'required',
            'Dependencia' => 'required',
            'UnidadHabilitada'=> 'required'
        ]);
        
        $unidad = new Unidad();
        $unidad->nombreUnidad = $request->nombreUnidad;
        // $unidad->codigoUnidad = $request->codigoUnidad;
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

        $request -> validate([
            'nombreUnidad' => 'required|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s.]+$/|unique:unidades,nombreUnidad',
        ]);

        $unidad->nombreUnidad = $request ->nombreUnidad;
        // $unidad->codigoUnidad = $unidad ->codigoUnidad;
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
    /*public function habilitarEstado(Request $request, Unidad $unidad){
        $unidad->save();
        return back(); 
    }*/
    //deshabilitar de forma jerarquica
    public function habilitarEstado(Request $request, $id) {
        // Iniciar una transacción para asegurarse de que todas las operaciones sean atómicas
        DB::transaction(function () use ($request, $id) {
            // Asegúrate de que el formulario ha sido enviado
            if ($request->input('form_submitted')) {
                // Encuentra la unidad usando el ID
                $unidad = Unidad::with('unidadesHijas')->findOrFail($id);
    
                // Determina el nuevo estado de habilitación
                // El checkbox marcado enviará "1", de lo contrario, asume que es "0"
                $estadoHabilitado = $request->has('UnidadHabilitada') ? 1 : 0;
    
                // Actualiza la unidad y sus hijas
                $this->actualizarEstadoHabilitado($unidad, $estadoHabilitado);
            }
        });
    
        // Redireccionar a la página anterior con un mensaje de éxito
        return back()->with('success', 'Estado actualizado correctamente.');
    }
    // Asegúrate de que la función actualizarEstadoHabilitado sea accesible
    private function actualizarEstadoHabilitado($unidad, $estadoHabilitado) {
        $unidad->UnidadHabilitada = $estadoHabilitado;
        $unidad->save();
    
        foreach ($unidad->unidadesHijas as $unidadHija) {
            $this->actualizarEstadoHabilitado($unidadHija, $estadoHabilitado);
        }
    }
    
    public function descargarUnidadesPDF(){
        $unidades = Unidad::all(); // Obtén todas las unidades

        // Invertir el orden de las unidades
        $unidades = $unidades->reverse();

        // Contar las páginas manualmente
        $itemsPerPage = 20; // Número de ítems por página
        $totalItems = $unidades->count();
        $totalPages = ceil($totalItems / $itemsPerPage);

        $pageNumber = 1; // Página actual
        $pageCount = $totalPages; // Total de páginas

        // Generar el PDF
        $pdf = PDF::loadView('pdf.unidades', compact('unidades', 'pageNumber', 'pageCount'));

        return $pdf->download('unidades.pdf');
    }
    
}
