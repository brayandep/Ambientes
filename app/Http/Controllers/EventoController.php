<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'descripcion' => 'max:300',
            'start' => 'required|date_format:Y-m-d H:i',
            'end' => 'date_format:Y-m-d H:i',
            'color' => 'required',
        ]);

        $datosEvento = Evento::create($request->all());
        return 'se registro el evento correctamente';
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
