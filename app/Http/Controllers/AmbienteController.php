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
    public function index()
    {
        $ambientes = Ambiente::all();
        return view('registrarAmbiente.index', compact('ambientes'));
    }

    public function create()
    {
        $unidades = Unidad::where('UnidadHabilitada', 1)->get();
        $tipoAmbientes = TipoAmbiente::all();
        $equiposDisponibles = Equipo::distinct()->pluck('nombreEquipo')->toArray();
        $equiposSeleccionados = null;
        $horariosDisponibles = [];
        $horariosDisponibles2 = [];
        return view('registrarAmbiente.registro', compact('unidades', 'tipoAmbientes','equiposDisponibles','equiposSeleccionados','horariosDisponibles','horariosDisponibles2'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:25|regex:/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚüÜ,. -]+$/|unique:ambientes,nombre',
            'capacidad' => 'required|numeric|min:15',
            'ubicacion' => 'required|max:400|regex:/^https?:\/\/www\.google\.com\/maps(\/.*)?$/',
            'descripcion' => 'nullable|max:120|regex:/^[a-zA-ZáéíóúÁÉÍÓÚüÜ,. -]+$/u',
            'unidad'=> 'required',
            'tipo-ambiente' => 'required',
            'equipos-disponibles' => 'required',
            'horarios' => 'required',
       ],
       [
            'capacidad.min' => 'El valor del campo capacidad debe ser al menos 15.',
            'unidad.required' => 'Seleccione una unidad.',
            'tipo-ambiente.required' => 'Seleccione un tipo de ambiente.',
            'ubicacion.regex' => 'La ubicación debe iniciar con: https://www.google.com/maps',
            'equipos-disponibles.required' => 'Seleccione al menos un equipo.',
            'horarios.required' => 'Seleccione al menos un horario.',
       ]);

        $ambiente = new Ambiente();
        
        $tipoID = 0;
        $tipoAmb = TipoAmbiente::where('nombreTipo', $request->input('tipo-ambiente'))->first();
        if ($tipoAmb === null) {
            $tipoAmbiente = new TipoAmbiente();
            $tipoAmbiente->nombreTipo = $request->input('tipo-ambiente');
            $tipoAmbiente->save();

            $ambiente->tipo_ambiente_id = $tipoAmbiente->id;
            $tipoID = $tipoAmbiente->id;
        } else {
            $ambiente->tipo_ambiente_id = $tipoAmb->id;
            $tipoID = $tipoAmb->id;
        }
        
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

        if($request->input('tipo-ambiente') === 'Auditorio') {
            $horarios = $request->input('horarios2', []);
            $horariosPorDia = [];
            foreach ($horarios as $horario) {
                if($horario !== "undefined undefined"){
                    $partes = explode(' ', $horario, 2);
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
        } else {
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

    public function show(Ambiente $ambiente)
    {
        // 
    }

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
        })->toArray();
        
        return view('registrarAmbiente.registro', compact('unidades', 'tipoAmbientes', 'ambienteDatos', 'equiposDisponibles', 'equiposSeleccionados', 'horariosDisponibles', 'horariosDisponibles2'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:25|regex:/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚüÜ,. -]+$/|unique:ambientes,nombre,' . $id,
            'capacidad' => 'required|numeric|min:15',
            'ubicacion' => 'required|max:400|regex:/^https?:\/\/www\.google\.com\/maps\/.*$/',
            'descripcion' => 'nullable|max:120|regex:/^[a-zA-ZáéíóúÁÉÍÓÚüÜ,. -]+$/u',
            'unidad'=> 'required',
            'tipo-ambiente'=> 'required',
            'equipos-disponibles' => 'required',
            'horarios' => 'required',
        ], [
            'capacidad.min' => 'El valor del campo capacidad debe ser al menos 15.',
            'unidad.required' => 'Seleccione una unidad.',
            'tipo-ambiente.required' => 'Seleccione un tipo de ambiente.',
            'ubicacion.regex' => 'La ubicación debe iniciar con: https://www.google.com/maps/',
            'equipos-disponibles.required' => 'Seleccione al menos un equipo.',
            'horarios.required' => 'Seleccione al menos un horario.',
        ]);

        $ambiente = Ambiente::findOrFail($id);

        $tipoID = 0;
        $tipoAmb = TipoAmbiente::where('nombreTipo', $request->input('tipo-ambiente'))->first();
        if ($tipoAmb === null) {
            $tipoAmbiente = new TipoAmbiente();
            $tipoAmbiente->nombreTipo = $request->input('tipo-ambiente');
            $tipoAmbiente->save();

            $ambiente->tipo_ambiente_id = $tipoAmbiente->id;
            $tipoID = $tipoAmbiente->id;
        } else {
            $ambiente->tipo_ambiente_id = $tipoAmb->id;
            $tipoID = $tipoAmb->id;
        }

        $ambiente->unidad = $request->unidad;
        $ambiente->nombre = $request->nombre;
        $ambiente->capacidad = $request->capacidad;
        $ambiente->ubicacion = $request->ubicacion;
        $ambiente->descripcion_ubicacion = $request->descripcion;
        $ambiente->save();

        Equipo::where('ambiente_id', $ambiente->id)->delete();

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

        HorarioDisponible::where('ambiente_id', $ambiente->id)->delete();

        $diasConv = [
            "Lunes" => 1,
            "Martes" => 2,
            "Miércoles" => 3,
            "Jueves" => 4,
            "Viernes" => 5,
            "Sábado" => 6,
        ];

        if ($request->input('tipo-ambiente') === 'Auditorio') {
            $horarios = $request->input('horarios2', []);
            $horariosPorDia = [];
            foreach ($horarios as $horario) {
                if ($horario !== "undefined undefined") {
                    $partes = explode(' ', $horario, 2);
                    if (count($partes) === 2) {
                        $dia = $partes[0];
                        $tiempo = $partes[1];
                        $horariosPorDia[$dia][] = $tiempo;
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
            foreach ($horariosFormateados as $horario) {
                if ($horario !== "undefined undefined") {
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
        } else {
            $horarios = $request->input('horarios', []);
            foreach ($horarios as $horario) {
                $partes = explode(' ', $horario);
                if (count($partes) === 3) {
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

    public function destroy($id)
    {
        Ambiente::find($id)->delete();
        return redirect()->back();
    }

    public function descargarAmbientesPDF()
    {
        $ambientes = Ambiente::all()->reverse(); // Obtén todos los ambientes e invierte el orden

        return view('pdf.ambientes',compact('ambientes'));
    }
}
