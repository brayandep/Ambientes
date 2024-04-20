<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'descripcion' => 'max:200',
            'start' => 'required|date_format:Y-m-d H:i',
            'end' => 'date_format:Y-m-d H:i',
            'color' => 'required',
        ],[
            'start.date_format' => 'Debe colocar una hora inicial.',
            'end.date_format' => 'Debe colocar una fecha y hora final.',
            'title.required' => 'Debe colocar un titulo.'
        ]);

        $datosEvento = Evento::create($request->all());
        return 'se registro el evento correctamente';
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:30',
            'descripcion' => 'max:200',
            'start' => 'required|date_format:Y-m-d H:i',
            'end' => 'date_format:Y-m-d H:i',
            'color' => 'required',
        ],[
            'start.date_format' => 'Debe colocar una hora inicial.',
            'end.date_format' => 'Debe colocar una fecha y hora final.',
            'title.required' => 'Debe colocar un titulo.'
        ]);

        $eventos=Evento::find($id);
        $eventos->update($request->all());
    }

    public function destroy($id)
    {
        $eventos=Evento::find($id);
        Evento::destroy($id);
    }
}
