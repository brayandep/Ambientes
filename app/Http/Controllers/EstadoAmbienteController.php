<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambiente;

class EstadoAmbienteController extends Controller
{
    // Otros métodos del controlador

    /**
     * Cambiar el estado de Habilitado de 0 a 1.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cambiarEstado(Request $request)
    {
        // Obtener el ID del ambiente y el nuevo estado de la solicitud
        $ambienteId = $request->input('ambiente_id');
        $nuevoEstado = $request->input('nuevo_estado');

        // Buscar el ambiente por su ID
        $ambiente = Ambiente::find($ambienteId);

        // Verificar si se encontró el ambiente y actualizar su estado si es así
        if ($ambiente) {
            $ambiente->estadoAmbiente = $nuevoEstado;
            $ambiente->save();
            return redirect()->back()->with('success', 'Estado cambiado correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró el ambiente.');
        }
    }
}
