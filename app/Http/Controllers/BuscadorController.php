<?php

namespace App\Http\Controllers;
use App\Models\Ambiente;
use Illuminate\Http\Request;
use App\Models\HorarioDisponible;

class BuscadorController extends Controller
{
    public function show(Request $request){
        $request->validate([
            'nombre' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/|max:25',
            'capacidad' => 'nullable|min:15|numeric',
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

        $nombre = $request->input('nombre'); // Valor predeterminado: cadena vacía si no se proporciona
        $capacidad = $request->input('capacidad'); // Valor predeterminado: cadena vacía si no se proporciona
        $dia = $request->input('dia');
        // $fecha = $request->input('fecha', date('Y-m-d'));
        $horaInicio = $request->input('horaInicio');
        $horaFin = $request->input('horaFin');

        // Obtener ambientes filtrados por nombre y/o capacidad
        $query = Ambiente::query();

        if (!empty($nombre)) {
            $query->where('nombre', 'like', "%$nombre%");
        }

        if (!empty($capacidad)) {
            $query->where('capacidad', '>=', $capacidad);
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

        $horarios = HorarioDisponible::query()
        ->where('estadoHorario', 1) // Filtrar por estado de horario si es necesario
        ->when(!empty($dia), function ($query) use ($dia) {
            $query->where('dia', $dia); // Filtrar por día si se ha seleccionado
        })
        ->when(!empty($horaInicio) && !empty($horaFin), function ($query) use ($horaInicio, $horaFin) {
            $query->where('horaInicio', '>=', $horaInicio)
                  ->where('horaFin', '<=', $horaFin);
        })
        ->orderBy('dia', 'asc')
        ->orderBy('horaInicio', 'asc')
        ->get();
        
        return view('Buscador.Buscador', 
        compact('ambientes', 'horarios', 'nombre', 'capacidad', 'diaSemana', 'horaInicio', 'horaFin'));
    }
}
