<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        // Obtener los registros de log ordenados por la fecha de creación de manera descendente
        //$logs = Log::orderBy('created_at', 'desc')->paginate(10); // Muestra 10 registros por página
        $logs = Log::with('user')->orderBy('created_at', 'desc')->paginate(10); // Muestra 10 registros por página

        // Pasar los registros de log a la vista
        return view('Log', ['logs' => $logs]);
    }
}
