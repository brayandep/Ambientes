<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Equipo;
use App\Models\HorarioDisponible;
use App\Models\TipoAmbiente;
use App\Models\Unidad;
use Illuminate\Http\Request;

use PDF;

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
        $unidades = Unidad::where('UnidadHabilitada', 1)->get();
        $tipoAmbientes = TipoAmbiente::all();
        $equiposDisponibles = Equipo::distinct()->pluck('nombreEquipo')->toArray();
        $equiposSeleccionados = null;
        $horariosDisponibles = [];
        $horariosDisponibles2 = [];
        return view('registrarAmbiente.registro', compact('unidades', 'tipoAmbientes','equiposDisponibles','equiposSeleccionados','horariosDisponibles','horariosDisponibles2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request -> validate([
            'codigo' => 'required|numeric|digits:5||unique:ambientes,codigo',
            'nombre' => 'required|max:25|regex:/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚüÜ,. -]+$/|unique:ambientes,nombre',
            'capacidad' => 'required|numeric|min:15',
            'ubicacion' => 'required|max:80|regex:/^https?:\/\/\www\.google\.com\/maps\/.*$/',
            'descripcion' => 'nullable|max:40|regex:/^[a-zA-ZáéíóúÁÉÍÓÚüÜ,. -]+$/u',
            'unidad'=> 'required',
            'tipo-ambiente'=> 'required'
       ],
       [
            'capacidad.min' => 'El valor del campo capacidad debe ser al menos 15.',
            'unidad.required' => 'Seleccione una unidad.',
            'tipo-ambiente.required' => 'Seleccione un tipo de ambiente.',
            'ubicacion.regex' => 'La ubicación debe iniciar con: https://www.google.com/maps/'
       ]);

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

        $diasConv = [
            "Lunes" => 1,
            "Martes" => 2,
            "Miércoles" => 3,
            "Jueves" => 4,
            "Viernes" => 5,
            "Sábado" => 6,
        ];

        if($request->input('tipo-ambiente') === 'Auditorio'){

            $horarios = $request->input('horarios2', []);
            $horariosPorDia = [];
            foreach ($horarios as $horario) {
                if($horario !== "undefined undefined"){
                    $partes = explode(' ', $horario,2);
                    if(count($partes) === 2){
                        $dia = $partes[0];
                        $tiempo = $partes[1];
                        $horariosPorDia[$dia][] = $tiempo;  // Agrupar por día
                    }
                }
            }
            $ultimoHorarioPorDia = [];
            foreach ($horariosPorDia as $dia => $horarios) {
                $ultimoHorarioPorDia[$dia] = end($horarios);  
            }
            $horariosFormateados = [];
            foreach ($ultimoHorarioPorDia as $dia => $horario) {
                $horariosFormateados[] = "$dia $horario";
            }
            //dd($horariosFormateados);
            foreach ($horariosFormateados as $horario) {
                if($horario !== "undefined undefined"){
                    $partes = explode(' ', $horario);
                    
                        $dia = $partes[0];
                        $horaInicio = $partes[1];
                        $horaFin = $partes[2];
                
                        $horarioDisponible = new HorarioDisponible();
                        $horarioDisponible->ambiente_id = $ambiente->id;
                        $horarioDisponible->horaInicio = $horaInicio;
                        $horarioDisponible->horaFin = $horaFin;
                        $horarioDisponible->estadoHorario = 1; 
                        if (array_key_exists($dia, $diasConv)) {
                            $numeroDelDia = $diasConv[$dia];
                            $horarioDisponible->dia = $numeroDelDia;
                        }
                        
                        $horarioDisponible->save();
                } 
            }
        }else{
            $horarios = $request->input('horarios', []);
            foreach ($horarios as $horario) {
                $partes = explode(' ', $horario);
                    if(count($partes) === 3){
                        $dia = $partes[0];
                        $horaInicio = $partes[1];
                        $horaFin = $partes[2];
                
                        $horarioDisponible = new HorarioDisponible();
                        $horarioDisponible->ambiente_id = $ambiente->id;
                        $horarioDisponible->horaInicio = $horaInicio;
                        $horarioDisponible->horaFin = $horaFin;
                        $horarioDisponible->estadoHorario = 1; 
                        if (array_key_exists($dia, $diasConv)) {
                            $numeroDelDia = $diasConv[$dia];
                            $horarioDisponible->dia = $numeroDelDia;
                        }
                        $horarioDisponible->save();
                    }
            }
        }
        
        return redirect('ver-ambientes');
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

        //$horariosExistente = HorarioDisponible::where('ambiente_id', $ambienteDatos->id)->get()->groupBy('dia');;
        $horario = HorarioDisponible::where('ambiente_id', $ambienteDatos->id)->get();

        
        
        $horariosDisponibles = $horario->map(function($horario) {
            $nombreDia = '';
            $dias = [
                1 => "Lunes",
                2 => "Martes",
                3 => "Miércoles",
                4 => "Jueves",
                5 => "Viernes",
                6 => "Sábado"
            ];
            
            if (array_key_exists($horario->dia, $dias)) {
                $nombreDia = $dias[$horario->dia];
            }
            return $nombreDia . ' ' . $horario->horaInicio . ' ' . $horario->horaFin;
        })->toArray();
        
        $horariosDisponibles2 = $horario->map(function($horario) {
            $nombreDia2 = '';
            $dias = [
                1 => "Lunes",
                2 => "Martes",
                3 => "Miércoles",
                4 => "Jueves",
                5 => "Viernes",
                6 => "Sábado"
            ];
            if (array_key_exists($horario->dia, $dias)) {
                $nombreDia2 = $dias[$horario->dia];
            }
            return $nombreDia2 . ' ' . $horario->horaInicio . ' ' . $horario->horaFin;
        })->toArray();;
        //dd($horariosDisponibles);
        return view('registrarAmbiente.registro', compact('unidades', 'tipoAmbientes','ambienteDatos','equiposDisponibles','equiposSeleccionados','horariosDisponibles', 'horariosDisponibles2'));
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

        $diasConv = [
            "Lunes" => 1,
            "Martes" => 2,
            "Miércoles" => 3,
            "Jueves" => 4,
            "Viernes" => 5,
            "Sábado" => 6,
        ];

        if($request->input('tipo-ambiente') === 'Auditorio'){

            $horarios = $request->input('horarios2', []);
            $horariosPorDia = [];
            foreach ($horarios as $horario) {
                if($horario !== "undefined undefined"){
                    
                    $partes = explode(' ', $horario,2);
                    if(count($partes) === 2){
                        $dia = $partes[0];
                        $tiempo = $partes[1];
                        $horariosPorDia[$dia][] = $tiempo;  // Agrupar por día
                    }
                }
            }
            $ultimoHorarioPorDia = [];
            foreach ($horariosPorDia as $dia => $horarios) {
                if (array_key_exists($dia, $diasConv)) {
                    $numeroDia = $diasConv[$dia];
                    HorarioDisponible::where('ambiente_id', $ambiente->id)->where('dia','=',$numeroDia)->delete();
                }
                $ultimoHorarioPorDia[$dia] = end($horarios);  
            }
            $horariosFormateados = [];
            foreach ($ultimoHorarioPorDia as $dia => $horario) {
                $horariosFormateados[] = "$dia $horario";
            }
            //dd($horariosFormateados);
            foreach ($horariosFormateados as $horario) {
                if($horario !== "undefined undefined"){
                    $partes = explode(' ', $horario);
                    $dia = $partes[0];
                    $horaInicio = $partes[1];
                    $horaFin = $partes[2];
            
                    $horarioDisponible = new HorarioDisponible();
                    $horarioDisponible->ambiente_id = $ambiente->id;
                    $horarioDisponible->horaInicio = $horaInicio;
                    $horarioDisponible->horaFin = $horaFin;
                    $horarioDisponible->estadoHorario = 1; 
                    if (array_key_exists($dia, $diasConv)) {
                        $numeroDelDia = $diasConv[$dia];
                        $horarioDisponible->dia = $numeroDelDia;
                    }
                    $horarioDisponible->save();
                } 
            }
        }else{
            HorarioDisponible::where('ambiente_id', $ambiente->id)->delete();
            $horarios = $request->input('horarios', []);
            foreach ($horarios as $horario) {
                if($horario !== "undefined undefined"){
                    $partes = explode(' ', $horario);
                    $dia = $partes[0];
                    $horaInicio = $partes[1];
                    $horaFin = $partes[2];
            
                    $horarioDisponible = new HorarioDisponible();
                    $horarioDisponible->ambiente_id = $ambiente->id;
                    $horarioDisponible->horaInicio = $horaInicio;
                    $horarioDisponible->horaFin = $horaFin;
                    $horarioDisponible->estadoHorario = 1; 
                    if (array_key_exists($dia, $diasConv)) {
                        $numeroDelDia = $diasConv[$dia];
                        $horarioDisponible->dia = $numeroDelDia;
                    }
                    
                    $horarioDisponible->save();
                }
            }
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

    public function descargarAmbientesPDF(){
        $ambientes = Ambiente::all(); // Obtén todos los ambientes
    
        // Invertir el orden de los ambientes
        $ambientes = $ambientes->reverse();
    
        // Contar las páginas manualmente
        $itemsPerPage = 20; // Número de ítems por página
        $totalItems = $ambientes->count();
        $totalPages = ceil($totalItems / $itemsPerPage);
    
        $pageNumber = 1; // Página actual
        $pageCount = $totalPages; // Total de páginas
    
        // Generar el PDF
        $pdf = PDF::loadView('pdf.ambientes', compact('ambientes', 'pageNumber', 'pageCount'));
    
        return $pdf->download('ambientes.pdf');
    }
}
