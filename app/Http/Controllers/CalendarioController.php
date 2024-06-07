<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Evento;
use App\Models\HorarioDisponible;
use App\Models\Models\Solicitud;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    public function index()
    {
        $eventos = array();
        $datos = Evento::all();

        foreach($datos as $dato){
            $eventos[] = [
                'id' => $dato->id,
                'title' => $dato->title,
                'descripcion' => $dato->descripcion,
                'start' => $dato->start,
                'end' => $dato->end,
                'backgroundColor' => $dato->color
            ];
        }

        
        if (Auth::check()){
            $regEvento = Auth::user()->can('Registrar evento');
            $editEvento = Auth::user()->can('Editar evento');
        }else{
            $regEvento = false;
            $editEvento = false;
        }
        // print_r($regEvento);
        // print_r($editEvento);
        return view('Calendario.general', compact('eventos', 'regEvento', 'editEvento'));
    }

    public function individual($idAmbiente)
    {
        $eventoSol = [];
        $eventos = array();
        $nombreAmbiente = Ambiente::select('nombre')->where('id',$idAmbiente)->first();
        $horariosAmbiente = HorarioDisponible::where('ambiente_id',$idAmbiente)->get();
        $solicitudes = Solicitud::where('estado', 'confirmado')->where('nro_aula',$idAmbiente)->get();
        // print($solicitudes);
        //print_r($diasAmbiente);
        foreach($horariosAmbiente as $dato){
            $eventos[] = [
                'title' => 'Libre',
                'startTime' => $dato->horaInicio,
                'endTime' => $dato->horaFin,
                'daysOfWeek' => $dato->dia,
            ];
        }
        foreach($solicitudes as $dato){
            $horariosSeparados = explode(" - ", $dato->horario);
            $hora1 = $horariosSeparados[0];
            $hora2 = $horariosSeparados[1];
            $fechaHoraIni = $dato->fecha . ' ' . $hora1;
            $fechaHoraFin = $dato->fecha . ' ' . $hora2;
            // print($fechaHoraIni);
            // print($fechaHoraFin);
            
            $eventoSol[] = [
                'title' => 'Ocupado',
                'backgroundColor' => '#F35D5D',
                'start' => $fechaHoraIni,
                'end' => $fechaHoraFin,
            ];
        }
        //print_r($eventos);
        return view('Calendario.individual', compact('nombreAmbiente','eventos','eventoSol'));
    }
}
