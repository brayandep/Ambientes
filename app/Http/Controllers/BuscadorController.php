<?php

namespace App\Http\Controllers;
use App\Models\Ambiente;
use Illuminate\Http\Request;
use App\Models\HorarioDisponible;

class BuscadorController extends Controller
{
    public function show(Request $request){
        $request->validate([
            'nombre' => 'nullable|string:25',
            'capacidad' => 'nullable|min:15|numeric',
            'horaInicio' => 'nullable|date_format:H:i|after_or_equal:06:45|before_or_equal:20:15',
            'horaFin' => [
                'nullable',
                'date_format:H:i',
                'after_or_equal:08:15',
                'before_or_equal:21:45',
                function ($attribute, $value, $fail) use ($request) {
                    // Validar que horaFin sea posterior a horaInicio si ambos están presentes
                    $horaInicio = $request->input('horaInicio');
                    if (!empty($horaInicio) && !empty($value)) {
                        if ($value <= $horaInicio) {
                            $fail('La hora de fin debe ser posterior a la hora de inicio.');
                        }
                    }
                },
            ],
        ]
        ) ;

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
        ->when(!empty($horaInicio), function ($query) use ($horaInicio) {
            $query->where('horaInicio', '>=', $horaInicio); // Filtrar por hora de inicio
        })
        ->when(!empty($horaFin), function ($query) use ($horaFin) {
            $query->where('horaFin', '<=', $horaFin); // Filtrar por hora de fin
        })
        ->orderBy('dia', 'asc')
        ->orderBy('horaInicio', 'asc')
        ->get();
        
        return view('Buscador.Buscador', 
        compact('ambientes', 'horarios', 'nombre', 'capacidad', 'diaSemana', 'horaInicio', 'horaFin'));
    }
}
