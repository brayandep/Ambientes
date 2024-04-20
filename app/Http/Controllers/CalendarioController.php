<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function index()
    {
        $eventos = array();
        $datos = Evento::all();

        foreach($datos as $dato){
            $eventos[] = [
                'title' => $dato->title,
                'descripcion' => $dato->descripcion,
                'start' => $dato->start,
                'end' => $dato->end,
                'backgroundColor' => $dato->color
            ];
        }

        return view('Calendario.general', compact('eventos'));
    }

    public function individual()
    {
        return view('Calendario.individual');
    }
}
