<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use Illuminate\Http\Request;

class EstadoAmbienteController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Obtener todos los ambientes
        $ambientes = Ambiente::all();
        
        // Retornar la vista con los ambientes
        return view('VerAmbientes', compact('ambientes'));
    }

    public function cambiarEstado(Request $request, $id)
    {
    $ambiente = Ambiente::find($id);
    $ambiente->estadoAmbiente = $request->estado == 1 ? 0 : 1;
    $ambiente->save();

    return redirect()->back()->with('success', 'Estado del ambiente actualizado correctamente');
    }
}
