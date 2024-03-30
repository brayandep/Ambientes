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
        $unidades = Unidad::all();
        $tipoAmbientes = TipoAmbiente::all();

        return view('registrarAmbiente.registro', compact('unidades', 'tipoAmbientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $tipoID = 0;
        $ambiente = new Ambiente();
        $tipoAmb = TipoAmbiente::where('nombreTipo', $request->input('tipo-ambiente'))->first();
        if ($tipoAmb === null) {
            $tipoAmbiente = new TipoAmbiente();
            $tipoAmbiente->nombreTipo = $request->input('otroAmbiente');
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

        //dd($ambiente);
        //dd($tipoID);

        $horarioDisponible = new HorarioDisponible();

        //dd($ambiente);
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
        
        //falta cargar equipos y horarios

        //$equipos = Equipo::find($id);

        //$horarios = HorarioDisponible::find($id);

        return view('registrarAmbiente.registro', compact('unidades', 'tipoAmbientes','ambienteDatos'));
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
        //dd($request);
        $ambiente = Ambiente::find($id);

        $tipoID = 0;
        $tipoAmb = TipoAmbiente::where('nombreTipo', $request->input('tipo-ambiente'))->first();
        if ($tipoAmb === null) {
            $tipoAmbiente = new TipoAmbiente();
            $tipoAmbiente->nombreTipo = $request->input('otroAmbiente');
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

        /*$equiposSeleccionados = $request->input('equipos-disponibles');
        if ($equiposSeleccionados) {
            foreach ($equiposSeleccionados as $equipo) {
                Equipo::create([
                    'tipo_ambiente_id' => $tipoID,
                    'ambiente_id' => $ambiente->id,
                    'nombreEquipo' => $equipo,
                    'estadoEquipo' => 1,
                ]);
            }
        }*/

        //falta actualizar equipos y horarios

        return redirect()->route('registro.index');

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
        //falta equipos y horarios

        return redirect()->route('registro.index');
    }
}
