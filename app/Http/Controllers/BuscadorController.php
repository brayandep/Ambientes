<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuscadorR;
use Illuminate\Http\Request;
use App\Models\Ambiente;
use App\Models\HorarioDisponible;

class BuscadorController extends Controller
{
    public function show(){
        $ambientes = Ambiente::orderBy('nombre', 'asc')->get();
        $horarios = HorarioDisponible::where('estadoHorario', 0)->get();
        return view('Buscador.Buscador', compact('ambientes', 'horarios'));
    }

    public function search(BuscadorR $request)
{
    $validatedData = $request->validated();
}
}
