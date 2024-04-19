<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuscadorR;
use Illuminate\Http\Request;
use App\Models\HorarioDisponible;
use Illuminate\Support\Facades\DB;

class BuscadorController extends Controller
{
    public function show(Request $request){
        $nombreSearch = trim($request->get('nombreSearch'));
        $ambientes = DB::table('ambientes')
        ->select('*')
        ->where('nombre', 'LIKE', '%'.$nombreSearch.'%')
        ->orderBy('nombre', 'asc')
        ->get();

        // Definir el orden personalizado de los días de la semana de lunes a sábado
        $ordenDias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];

        $horarios = HorarioDisponible::where('estadoHorario', 0)
        ->orderByRaw("FIELD(dia, '" . implode("','", $ordenDias) . "')") // Ordenar por días personalizados
        ->orderBy('horaInicio', 'asc') // Luego ordenar por hora de inicio
        ->get();
        
        return view('Buscador.Buscador', compact('ambientes', 'horarios', 'nombreSearch'));
    }
}
