<?php

namespace App\Http\Controllers;
use App\Models\Ambiente;
use Illuminate\Http\Request;
use App\Models\HorarioDisponible;
use App\Models\Models\Solicitud;
use Illuminate\Support\Str;


class BuscadorController extends Controller
{
    public function show(Request $request){
        $request->validate([
            'nombre' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/|max:25',
            'capacidad' => 'nullable|min:15|numeric',
            'fecha' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // Validar que la fecha seleccionada no sea domingo
                    if (!empty($value) && date('N', strtotime($value)) == 7) {
                        $fail('No se permite seleccionar el día domingo.');
                    }
                },
            ],
            'horaInicio' => [
                'nullable',
                'date_format:H:i',
                'after_or_equal:06:45',
                'before_or_equal:20:15',
                function ($attribute, $value, $fail) use ($request) {
                    // Validar dependencia con horaFin
                    if (!empty($value) && empty($request->input('horaFin'))) {
                        $fail('Debes introducir una hora de fin para realizar una búsqueda por hora.');
                    }
                },
            ],
            'horaFin' => [
                'nullable',
                'date_format:H:i',
                'after_or_equal:08:15',
                'before_or_equal:21:45',
                function ($attribute, $value, $fail) use ($request) {
                    // Validar dependencia con horaInicio
                    if (!empty($value) && empty($request->input('horaInicio'))) {
                        $fail('Debes introducir una hora de inicio para realizar una búsqueda por hora.');
                    }
                    // Validar si horaFin es anterior a horaInicio
                    $horaInicio = $request->input('horaInicio');
                    if (!empty($value) && !empty($horaInicio) && $value <= $horaInicio) {
                        $fail('La hora de fin debe ser posterior a la hora de inicio.');
                    }
                },
            ],
            ],
            [
                'capacidad.min' => 'El valor del campo capacidad debe ser al menos 15.',
                'horaInicio.after_or_equal' => 'La hora de inicio debe ser igual o posterior a las 06:45 AM.',
                'horaInicio.before_or_equal' => 'La hora de inicio debe ser igual o anterior o igual a las 08:15 PM.',
                'horaFin.after_or_equal' => 'La hora de fin debe ser igual o posterior a las 08:15 AM.',
                'horaFin.before_or_equal' => 'La hora de fin debe ser igual o anterior o igual a las 09:45 PM.',
            ]);

        $nombre = $request->input('nombre'); 
        $capacidad = $request->input('capacidad'); 
        $dia = $request->input('dia');
        $fecha = $request->input('fecha');
        $horaInicio = $request->input('horaInicio');
        $horaFin = $request->input('horaFin');

        // Obtener ambientes filtrados por nombre y/o capacidad
        $query = Ambiente::query();

        if (!empty($nombre)) {
            $query->where('nombre', 'like', "%$nombre%");
        }

        if (!empty($capacidad)) {
            $query->where('capacidad', $capacidad);
        
            // Si no hay ambientes con la capacidad exacta, buscar el siguiente valor superior
            if ($query->count() === 0) {
                $query->orWhere('capacidad', '>=', $capacidad);
            }
        }        

        $ambientes = $query->orderBy('nombre', 'asc')->get();

        $diaSemana = [
            '1' => 'Lunes',
            '2' => 'Martes',
            '3' => 'Miércoles',
            '4' => 'Jueves',
            '5' => 'Viernes',
            '6' => 'Sábado',
        ];

        // Convertir la fecha en el número correspondiente al día de la semana
    $fechaNumero = date('N', strtotime($fecha));

    // Filtrar los horarios disponibles
    $horarios = HorarioDisponible::query()
        ->where('estadoHorario', 1) // Filtrar por estado de horario si es necesario
        ->when(!empty($fecha), function ($query) use ($fechaNumero) {
            $query->where('dia', $fechaNumero); // Filtrar por fecha si existe
        })
        ->when(!empty($dia), function ($query) use ($dia) {
            $query->where('dia', $dia); // Filtrar por día si se ha seleccionado
        })
        ->when(!empty($horaInicio) && !empty($horaFin), function ($query) use ($horaInicio, $horaFin) {
            $query->where(function ($query) use ($horaInicio, $horaFin) {
                $query->where('horaInicio', '>=', $horaInicio)
                      ->where('horaFin', '<=', $horaFin);
            })->orWhere(function ($query) use ($horaInicio, $horaFin) {
                $query->where('horaInicio', '<=', $horaInicio)
                      ->where('horaFin', '>=', $horaInicio);
            })->orWhere(function ($query) use ($horaInicio, $horaFin) {
                $query->where('horaInicio', '<=', $horaFin)
                      ->where('horaFin', '>=', $horaFin);
            });
        })
        ->orderBy('dia', 'asc')
        ->orderBy('horaInicio', 'asc')
        ->get();

    // Obtener todas las solicitudes confirmadas para la fecha seleccionada
    $solicitudesConfirmadas = Solicitud::where('fecha', $fecha)
        ->where('estado', 'confirmado')
        ->get();

    // Filtrar los horarios para eliminar los ocupados por solicitudes confirmadas
    foreach ($horarios as $key => $horario) {
        foreach ($solicitudesConfirmadas as $solicitud) {
            list($horaInicioSolicitud, $horaFinSolicitud) = explode(' - ', $solicitud->horario);
            if ($horario->horaInicio >= $horaInicioSolicitud && $horario->horaFin <= $horaFinSolicitud) {
                unset($horarios[$key]);
                break;
            }
        }
    }

        return view('Buscador.Buscador', 
        compact('ambientes', 'horarios', 'nombre', 'capacidad', 'diaSemana', 'horaInicio', 'horaFin', 'fecha'));
    }
}
