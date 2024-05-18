<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Solicitud;
use App\Models\Ambiente;
use App\Models\Docente;
use App\Models\HorarioDisponible;
use App\Models\Models\Usuario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;

use App\Models\UsuarioPrueba;
use App\Http\Controllers\CorreoController; // Importa el controlador de correo


use Illuminate\Support\Facades\Redirect;
class SolicitudController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $solicitudes = Solicitud::where('usuario', $usuario->id)->get();
        $horarios = HorarioDisponible::all();;
        $ambientes = Ambiente::all();;
        
        $usuarios = User::all();;
        return view('VerSolicitud', compact('solicitudes','horarios','ambientes', 'usuario','usuarios'));
    }

    public function index2()
    {
        $solicitudes = Solicitud::all(); // Obtén todas las solicitudes desde el modelo Solicitud
        $usuarios = Usuario::all();;
        $horarios = HorarioDisponible::all();;
        $ambientes = Ambiente::all();;
        $usuario = Auth::user();
         return view('HabilitarReservas', compact('solicitudes','usuarios','horarios','ambientes', 'usuario'));
    }


public function create()
{
        
     
    $docentes = Docente::all(); 
    $ambientes = Ambiente::where('estadoAmbiente', 1)->get();
    $horarios = HorarioDisponible::all();
    $usuario = Auth::user();
    // Obtén todas las solicitudes desde el modelo Solicitud
    //  $usuarios = Usuario::all();;

    return view('SolicitudAmbiente', compact( 'docentes', 'ambientes','horarios', 'usuario'));

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
       // Verifica si ya existe una solicitud con los mismos datos
    $solicitudExistente = Solicitud::where('fecha', $request->fecha)
    ->where('nro_aula', $request->nro_aula)
    ->where('horario', $request->horario)
    ->where('estado', 'confirmado')
    ->exists();

// Si existe una solicitud con los mismos datos y estado confirmado, muestra un mensaje de error
if ($solicitudExistente) {
    return Redirect::back()->withErrors(['error' => 'El ambiente está ocupado en el horario seleccionado.']);
}

// Si no existe una solicitud con los mismos datos o si existe pero no está confirmada, procede a guardar la solicitud
$solicitud = new Solicitud();
$solicitud->usuario = $request->usuario;
$solicitud->fecha = $request->fecha;
$solicitud->nombre = $request->nombre;
$solicitud->motivo = $request->motivo;
$solicitud->materia = $request->materia;
$solicitud->grupo = $request->grupo;
$solicitud->nro_aula = $request->nro_aula;
$solicitud->horario = $request->horario;
$solicitud->estado = 'Sin confirmar';
$solicitud->save();

// Redirige a la vista de solicitud con un mensaje de éxito
return redirect()->route('VerSolicitud')->with('success', 'Solicitud registrada exitosamente.');

}       
public function edit($id ){
          $usuario = Auth::user();
        $usuario = Auth::user();
        $solicitudes = Solicitud::where('usuario', $usuario->id)->get();
        $solicitud = Solicitud::findOrFail($id);
        $ambientes = Ambiente::all();;
        $horarios = HorarioDisponible::all();;
        $idAmbienteSeleccionado = $solicitud->ambiente_id;
       // return $solicitud;
        return view('editSolicitud', compact('solicitud','ambientes','horarios','idAmbienteSeleccionado','usuario'));
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

public function habilitar(Solicitud $id)
{
    $id->estado = "confirmado";
    $id->save();
    
    // Obtener el usuario y ambiente asociados a la solicitud
    $usuario = User::find($id->usuario);
    $ambiente = Ambiente::find($id->nro_aula);

    if ($usuario && $ambiente) {
        // Enviar correo de confirmación
        $correo_destino = $usuario->email;
        $nombre_usuario = $usuario->nombre;
        $nombre_ambiente = $ambiente->nombre;
        $horario = $id->horario;
        $fecha_solicitud = $id->fecha;
        
        $correoController = new CorreoController();
        $correoController->enviarCorreoConfirmacion($correo_destino, $nombre_usuario, $horario, $nombre_ambiente, $fecha_solicitud);
        
        // Actualizar el estado de otras solicitudes
        $solicitudes = Solicitud::where('fecha', $id->fecha)
            ->where('horario', $id->horario)
            ->where('nro_aula', $id->nro_aula)
            ->where($id->getKeyName(), '!=', $id->getKey())
            ->get();

        foreach ($solicitudes as $solicitud) {
            $solicitud->estado = "denegado";
            $solicitud->save();
            
            // Enviar correo de rechazo para cada solicitud denegada
            $usuario_denegado = User::find($solicitud->usuario);
            if ($usuario_denegado) {
                $correo_destino_denegado = $usuario_denegado->email;
                $nombre_usuario_denegado = $usuario_denegado->nombre;
                $correoController->enviarCorreoRechazo($correo_destino_denegado, $nombre_usuario_denegado, $horario, $nombre_ambiente, $fecha_solicitud);
            }
        }

        return redirect()->route('habilitarReservas')->with('success', 'Solicitud confirmada y correos electrónicos enviados.');
    } else {
        return redirect()->route('habilitarReservas')->with('error', 'No se encontró el usuario o el ambiente asociado a la solicitud.');
    }
}

public function denegar(Solicitud $id)
{
    $id->estado = "denegado";
    $id->save();
    
    // Obtener el usuario y ambiente asociados a la solicitud
    $usuario = User::find($id->usuario);
    $ambiente = Ambiente::find($id->nro_aula);

    if ($usuario && $ambiente) {
        // Enviar correo de rechazo
        $correo_destino = $usuario->email;
        $nombre_usuario = $usuario->nombre;
        $nombre_ambiente = $ambiente->nombre;
        $horario = $id->horario;
        $fecha_solicitud = $id->fecha;
        
        $correoController = new CorreoController();
        $correoController->enviarCorreoRechazo($correo_destino, $nombre_usuario, $horario, $nombre_ambiente, $fecha_solicitud);

        return redirect()->route('habilitarReservas')->with('success', 'Solicitud rechazada y correo electrónico enviado.');
    } else {
        return redirect()->route('habilitarReservas')->with('error', 'No se encontró el usuario o el ambiente asociado a la solicitud.');
    }
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
    $ambientes = Ambiente::all();;
     $estado = $request->input('estado');
    if($estado == "todos"){
        $solicitudes = Solicitud::all();
    }else{
        $solicitudes = Solicitud::where("estado",$estado)->get();
    }
    return view('habilitarReservas', compact('solicitudes','ambientes'));
}

public function descargarReservasPDF(){
    $solicitudes = Solicitud::all(); // Obtén todas las solicitudes

    // Obtener información de los ambientes
    $ambientes = Ambiente::all();

    // Invertir el orden de las solicitudes
    //$solicitudes = $solicitudes->reverse();

    // Contar las páginas manualmente
    $itemsPerPage = 20; // Número de ítems por página
    $totalItems = $solicitudes->count();
    $totalPages = ceil($totalItems / $itemsPerPage);

    $pageNumber = 1; // Página actual
    $pageCount = $totalPages; // Total de páginas

    // Generar el PDF
    $pdf = PDF::loadView('pdf.solicitudes', compact('solicitudes', 'pageNumber', 'pageCount', 'ambientes'));

    return $pdf->download('reservas.pdf');
}

}