<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambiente; // Asegúrate de importar el modelo Ambiente si aún no lo has hecho

class buscadorController extends Controller
{
    public function __invoke()
    {
        return view('buscador');
    }
    public function buscarAmbientes(Request $request)
    {
        // Obtener el término de búsqueda del formulario
        $nombre = $request->input('nombre');
        $capacidad = $request->input('capacidad');
        $dia = $request->input('dia');
        $horaInicio = $request->input('hora_inicio');
        $horaFin = $request->input('hora_fin');

        // Inicializar la consulta
        $query = Ambiente::query();

        // Aplicar los filtros según los términos de búsqueda
        if (!empty($nombre)) {
            $query->where('nombre', 'like', '%'.$nombre.'%');
        }
        if (!empty($capacidad)) {
            $minCapacidad = $capacidad - 5;

            // Aplicar el filtro de capacidad con un mínimo
            $query->where('capacidad', '>=', $minCapacidad);
        }
        // Aplicar el filtro de horario disponible si se proporciona hora de inicio y hora de fin
        if (!empty($horaInicio) && !empty($horaFin)) {
            $query->whereHas('horarioDisponible', function ($q) use ($dia, $horaInicio, $horaFin) {
                // Aplicar el filtro de día si se proporciona
                if (!empty($dia)) {
                    $q->where('dia', $dia);
                }
                $q->where('horaInicio', '<=', $horaInicio)
                  ->where('horaFin', '>=', $horaFin);
            });
        }
        // Realizar la búsqueda
        $ambientes = $query->get();

        // Verificar si no se encontraron ambientes disponibles para el día especificado
        $sinDisponibilidad = $dia && $ambientes->isEmpty();

        // Pasar los resultados a la vista
        return view('buscador', compact('ambientes'));
    }
    /*public function buscarAmbientes(Request $request)
    {
    // Recuperar los datos de búsqueda del objeto $request
    $nombre = $request->input('nombre');
    $dia = $request->input('dia');
    $fecha = $request->input('fecha');
    $hora_inicio = $request->input('hora_inicio');
    $hora_fin = $request->input('hora_fin');
    $capacidad = $request->input('capacidad');

    // Realizar la búsqueda en la base de datos utilizando los datos recibidos
    $ambientes = Ambiente::where('nombre', 'like', '%'.$nombre.'%')
                         ->where('dia', $dia)
                         ->where('fecha', $fecha)
                         ->where('hora_inicio', $hora_inicio)
                         ->where('hora_fin', $hora_fin)
                         ->where('capacidad', $capacidad)
                         ->get();

    // Devolver los resultados a la vista
    return view('buscador', compact('ambientes'));
    }*/

}

