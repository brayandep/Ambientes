<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Equipo;
use App\Models\HorarioDisponible;
use App\Models\TipoAmbiente;
use App\Models\Unidad;
use Illuminate\Http\Request;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambientes = Ambiente::all();
        return view('registrarAmbiente.index', compact('ambientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidad::where('UnidadHabilitada', 1)->get();
        $tipoAmbientes = TipoAmbiente::all();
        $equiposDisponibles = Equipo::distinct()->pluck('nombreEquipo')->toArray();
        $equiposSeleccionados = null;
        $horariosExistente = null;
        //dd($equiposDisponibles);
        return view('registrarAmbiente.registro', compact('unidades', 'tipoAmbientes','equiposDisponibles','equiposSeleccionados','horariosExistente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $ambiente = new Ambiente();
        
        $tipoID = 0;
        $ambiente = new Ambiente();
        $tipoAmb = TipoAmbiente::where('nombreTipo', $request->input('tipo-ambiente'))->first();
        if ($tipoAmb === null) {
            $tipoAmbiente = new TipoAmbiente();
            $tipoAmbiente->nombreTipo = $request->input('tipo-ambiente');
            $tipoAmbiente->save();

            $ambiente->tipo_ambiente_id =$tipoAmbiente->id;
            $tipoID = $tipoAmbiente->id;
        } else {
            $ambiente->tipo_ambiente_id =$tipoAmb->id;
            $tipoID = $tipoAmb->id;
        }
        
        $ambiente->codigo = $request->codigo;
        $ambiente->unidad = $request->unidad;
        $ambiente->nombre = $request->nombre;
        $ambiente->capacidad = $request->capacidad;
        $ambiente->ubicacion = $request->ubicacion;
        $ambiente->descripcion_ubicacion = $request->descripcion;
        $ambiente->estadoAmbiente = 1;
        $ambiente->save();

        $equiposSeleccionados = $request->input('equipos-disponibles');
        if ($equiposSeleccionados) {
            foreach ($equiposSeleccionados as $equipo) {
                Equipo::create([
                    'tipo_ambiente_id' => $tipoID,
                    'ambiente_id' => $ambiente->id,
                    'nombreEquipo' => $equipo,
                    'estadoEquipo' => 1,
                ]);
            }
        }

        $datosDiaSemana = $request->diaSemana;
        
        foreach ($datosDiaSemana as $dia => $dats) {

            $datos = json_decode($dats, true);
            
            if ($datos !== null && is_array($datos)) {
                foreach ($datos as $dato) {
                    
                    $inicio = $dato['inicio'];
                    $fin = $dato['fin'];
                    $horarioDisponible = new HorarioDisponible();
                    $horarioDisponible->ambiente_id = $ambiente->id;
                    $horarioDisponible->horaInicio = $inicio;
                    $horarioDisponible->horaFin = $fin;
                    $horarioDisponible->estadoHorario = 1;
                    $horarioDisponible->dia = $dia;
                    $horarioDisponible->save();
                }
            }  
        }

        $datosDiaSem = $request->horario;
        
        foreach ($datosDiaSem as $dia => $dats) {

            $datos = json_decode($dats, true);
            
            if ($datos !== null && is_array($datos)) {
                foreach ($datos as $dato) {
                    
                    $inicio = $dato['inicio'];
                    $fin = $dato['fin'];
                    //dd($inicio, $fin);
                    $horarioDisponible = new HorarioDisponible();
                    $horarioDisponible->ambiente_id = $ambiente->id;
                    $horarioDisponible->horaInicio = $inicio;
                    $horarioDisponible->horaFin = $fin;
                    $horarioDisponible->estadoHorario = 1;
                    $horarioDisponible->dia = $dia;
                    $horarioDisponible->save();
                }
            }  
        }

        
        return redirect('registro');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function show(Ambiente $ambiente)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidades = Unidad::all();
        $tipoAmbientes = TipoAmbiente::all();
        $ambienteDatos = Ambiente::find($id);

        $equipos = Equipo::where('ambiente_id', $ambienteDatos->id)->get();
        
        $tipoAmbienteID = TipoAmbiente::find($ambienteDatos->tipo_ambiente_id);
        
        $equiposDisponibles = Equipo::distinct()->pluck('nombreEquipo')->toArray();

        if ($equipos->count() > 0) {
            $equiposSeleccionados = $equipos->pluck('nombreEquipo')->toArray();
        } else {
            $equiposSeleccionados = null;
        }
        //falta cargar equipos y horarios

        //$equipos = Equipo::find($id);

        $horariosExistente = HorarioDisponible::where('ambiente_id', $ambienteDatos->id)->get()->groupBy('dia');;
    
        

        return view('registrarAmbiente.registro', compact('unidades', 'tipoAmbientes','ambienteDatos','equiposDisponibles','equiposSeleccionados','horariosExistente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
        $ambiente = Ambiente::find($id);

        $tipoID = 0;
        $tipoAmb = TipoAmbiente::where('nombreTipo', $request->input('tipo-ambiente'))->first();
        if ($tipoAmb === null) {
            $tipoAmbiente = new TipoAmbiente();
            $tipoAmbiente->nombreTipo = $request->input('tipo-ambiente');
            $tipoAmbiente->save();

            $ambiente->tipo_ambiente_id =$tipoAmbiente->id;
            $tipoID = $tipoAmbiente->id;
        } else {
            $ambiente->tipo_ambiente_id =$tipoAmb->id;
            $tipoID = $tipoAmb->id;
        }
        
        $ambiente->codigo = $request->codigo;
        $ambiente->unidad = $request->unidad;
        $ambiente->nombre = $request->nombre;
        $ambiente->capacidad = $request->capacidad;
        $ambiente->ubicacion = $request->ubicacion;
        $ambiente->descripcion_ubicacion = $request->descripcion;
        $ambiente->estadoAmbiente = 1;
        $ambiente->save();

        $equiposSeleccionados = $request->input('equipos-disponibles');
        $equiposExistentes = Equipo::where('ambiente_id', $ambiente->id)->get();

            if ($equiposSeleccionados) {
                foreach ($equiposSeleccionados as $equipo) {

                    $equipoExistente = Equipo::where('ambiente_id', $ambiente->id)->get()
                        ->where('nombreEquipo', $equipo)
                        ->first();

                    if (!$equipoExistente) {
                        Equipo::create([
                            'tipo_ambiente_id' => $tipoID,
                            'ambiente_id' => $ambiente->id,
                            'nombreEquipo' => $equipo,
                            'estadoEquipo' => 1,
                        ]);
                    }
                }
            }

        foreach ($equiposExistentes as $equipoExistente) {
            if (!in_array($equipoExistente->nombreEquipo, $equiposSeleccionados)) {
                $equipoExistente->delete();
            }
        }

        $datosDiaSemana = $request->diaSemana;
        
        foreach ($datosDiaSemana as $dia => $dats) {

            $datos = json_decode($dats, true);
            
            if ($datos !== null && is_array($datos)) {
                foreach ($datos as $dato) {
                    
                    $inicio = $dato['inicio'];
                    $fin = $dato['fin'];
                    $horarioDisponible = new HorarioDisponible();
                    $horarioDisponible->ambiente_id = $ambiente->id;
                    $horarioDisponible->horaInicio = $inicio;
                    $horarioDisponible->horaFin = $fin;
                    $horarioDisponible->estadoHorario = 1;
                    $horarioDisponible->dia = $dia;
                    $horarioDisponible->save();
                }
            }  
        }

        if ($request->has('borrar')) {
            $idsAEliminar = $request->borrar;
            HorarioDisponible::destroy($idsAEliminar);
        }

        

        return redirect()->route('AmbientesRegistrados');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ambiente = Ambiente::find($id);
        $ambiente->delete();

        $equipos= Equipo::where('ambiente_id', $ambiente->id)->get();
        foreach ($equipos as $equipo) {
            $equipo->delete();
        }

        $horarios= HorarioDisponible::where('ambiente_id', $ambiente->id)->get();
        foreach ($horarios as $horario) {
            $horario->delete();
}
        return redirect()->route('registro.index');
    }
}
