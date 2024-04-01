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

    
}
