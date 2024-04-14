<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Solicitud;
use App\Models\Ambiente;
use App\Models\HorarioDisponible;
use App\Models\Models\Usuario;
class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::all(); // Obtén todas las solicitudes desde el modelo Solicitud
        $usuarios = Usuario::all();;
        $horarios = HorarioDisponible::all();;
        $ambientes = Ambiente::all();;
  return view('VerSolicitud', compact('solicitudes','usuarios','horarios','ambientes'));
    }

    public function index2()
    {
        $solicitudes = Solicitud::all(); // Obtén todas las solicitudes desde el modelo Solicitud
        $usuarios = Usuario::all();;
        $horarios = HorarioDisponible::all();;
        $ambientes = Ambiente::all();;
  return view('HabilitaReserva', compact('solicitudes','usuarios','horarios','ambientes'));
    }
    public function create()
    {
        
        
$usuarios = Usuario::all();
$solicitudes = Solicitud::all(); 
$ambientes = Ambiente::all();;
$horarios = HorarioDisponible::all();;
// Obtén todas las solicitudes desde el modelo Solicitud
//  $usuarios = Usuario::all();;
return view('SolicitudAmbiente', compact( 'usuarios', 'ambientes','horarios'));

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
        $Solicitud->estado = 'Sin confirmar';;
        $Solicitud->save();
        return redirect()->route('solicitud.store')->with('success', 'Solicitud creada exitosamente.');

}       
    public function edit($id ){
        
        $solicitud = Solicitud::findOrFail($id);
        $ambientes = Ambiente::all();;
        $horarios = HorarioDisponible::all();;
        $idAmbienteSeleccionado = $solicitud->ambiente_id;
       // return $solicitud;
        return view('editSolicitud', compact('solicitud','ambientes','horarios','idAmbienteSeleccionado'));
    }
    public function update(Request $request, Solicitud $solicitud)
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

    
    $solicitud ->usuario = $request->usuario;
    $solicitud ->nro_aula = $request->nro_aula;
    $solicitud ->materia = $request->materia;
    $solicitud ->grupo = $request->grupo;
    $solicitud ->motivo = $request->motivo;
    $solicitud ->fecha = $request->fecha;
    $solicitud ->horario = $request->horario;
    $solicitud->save();
  //  $solicitud->update($request->all());

    return redirect()->route('VerSolicitud')->with('success', 'Solicitud actualizada exitosamente.');

}
public function destroy($id)
{
    $solicitud = Solicitud::findOrFail($id);
    $solicitud->delete();
    return redirect()->route('VerSolicitud')->with('success', 'Solicitud eliminada correctamente.');
}

}