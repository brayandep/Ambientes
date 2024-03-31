<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Solicitud;
use App\Models\Models\Usuario;
class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::all(); // Obtén todas las solicitudes desde el modelo Solicitud
  //  return view('Versolicitud', compact('solicitudes'));
 // dd($Solicitud);
  return view('VerSolicitud', compact('solicitudes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'nro_aula' => 'required',
            'materia' => 'required',
            'grupo' => 'required',
            'motivo' => 'required',
            'fecha' => 'required|date',
            'horario' => 'required',
        ]);
        $Solicitud = new Solicitud();
        
        $Solicitud->usuario = $request['usuario'];
        $Solicitud->fecha = $request['fecha'];
        $Solicitud->motivo = $request['motivo'];
        $Solicitud->materia = $request['materia'];
        $Solicitud->grupo = $request['grupo'];
        $Solicitud->nro_aula = $request['nro_aula'];
        $Solicitud->horario = $request['horario'];
       
        
        $Solicitud->save();
        return redirect()->route('SolicitudAmbiente')->with('success', 'Solicitud creada exitosamente.');

}       
    public function edit(Solicitud $solicitud ){
        $solicitud = Solicitud::findOrFail($solicitud);
        return view('edit', compact('solicitud'));
    }
    public function update(Request $request, $solicitud)
{
    $request->validate([
        'usuario' => 'required',
        'nro_aula' => 'required',
        'materia' => 'required',
        'grupo' => 'required',
        'motivo' => 'required',
        'fecha' => 'required|date',
        'horario' => 'required',
    ]);

    $solicitud = Solicitud::findOrFail($solicitud);
    $solicitud->update($request->all());

    return redirect()->route('VerSolicitud')->with('success', 'Solicitud actualizada exitosamente.');

}
public function destroy(Solicitud $solicitud){
    $solicitud = Solicitud::findOrFail($solicitud);
    $solicitud->delete();
    return redirect()->route('VerSolicitud')->with('success', 'Solicitud eliminada correctamente.');

}

}