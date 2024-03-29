<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Solicitud;

class SolicitudController extends Controller
{
    public function index()
    {
        return view('SolicitudAmbiente');
    }

    public function store(Request $request)
    {
        // Validación de campos y almacenamiento de la solicitud
        $request->validate([
            'motivo' => 'required|string|max:255',
            // Otros campos de solicitud según sea necesario
        ]);

        Solicitud::create([
            'motivo' => $request->motivo,
            // Otros campos de solicitud según sea necesario
        ]);

        return redirect()->route('solicitud.index')->with('solicitud_enviada', true);

}
}
