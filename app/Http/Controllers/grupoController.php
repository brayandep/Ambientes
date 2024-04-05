<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnlaceGrupoDocente;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Http\Request;

class grupoController extends Controller
{
    public function create($materia)
    {   
        $mimateria = Materia::find($materia);
        $grupos = Grupo::where('materia', $materia)->get();

        return view('materia.enlaceGrupo', compact('grupos', 'mimateria'));
    }

    public function store(EnlaceGrupoDocente $request, Grupo $grupo)
    {
        $grupo->update($request->all());

        return redirect()->route('materia.show');
    }
}
