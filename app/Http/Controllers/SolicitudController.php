<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Solicitud;
use App\Models\Ambiente;
use App\Models\Docente;
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
         return view('HabilitarReservas', compact('solicitudes','usuarios','horarios','ambientes'));
    }
public function create()
{
        
        
    $docentes = Docente::all(); 
    $ambientes = Ambiente::all();;
    $horarios = HorarioDisponible::all();;
    // Obtén todas las solicitudes desde el modelo Solicitud
    //  $usuarios = Usuario::all();;
    $diasUnicos = HorarioDisponible::select('dia')->where('ambiente_id', 2)->distinct()->pluck('dia');
    print_r($diasUnicos);


    return view('SolicitudAmbiente', compact( 'docentes', 'ambientes','horarios','diasUnicos'));

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
        return redirect()->route('VerSolicitud');

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
public function suspender(Solicitud $id){
    $id->estado = "suspendido";
    $id->save();
    return redirect()->route('VerSolicitud');
}
public function habilitar(Solicitud $id){
    $id->estado = "confirmado";
    $id->save();
     // Busca todas las solicitudes con la misma fecha, horario y aula
     $solicitudes = Solicitud::where('fecha', $id->fecha)
     ->where('horario', $id->horario)
     ->where('nro_aula', $id->nro_aula)
     ->where($id->getKeyName(), '!=', $id->getKey()) // Utilizar el nombre de la columna de la clave primaria
     ->get();

    // Actualiza el estado de las solicitudes encontradas a "denegado"
    foreach ($solicitudes as $solicitud) {
    $solicitud->estado = "denegado";
    $solicitud->save();
    }
    return redirect()->route('habilitarReservas');
}
public function denegar(Solicitud $id){
    $id->estado = "denegado";
    $id->save();
    return redirect()->route('habilitarReservas');
}
/*public function confirmar(Solicitud $solicitud)
{
    // Actualiza el estado de la solicitud a "confirmado"
    $solicitud->estado = 'confirmado';
    $solicitud->save();

    // Puedes devolver una respuesta JSON si lo prefieres
    return response()->json(['message' => 'Solicitud confirmada exitosamente']);
}*/

public function solicitudMostrar(Request $request){
     $estado = $request->input('estado');
    if($estado == "todos"){
        $solicitudes = Solicitud::all();
    }else{
        $solicitudes = Solicitud::where("estado",$estado)->get();
    }
    return view('habilitarReservas', compact('solicitudes'));
}

}