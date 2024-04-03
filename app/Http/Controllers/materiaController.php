<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class materiaController extends Controller
{
    public function create()
    {
        return view('materia.registrar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'departamento' => 'required',
            'carrera' => 'required',
            'nombre' => 'required',
            'codigo' => 'required',
            'nivel' => 'required',
            'cantGrupo' => 'required'
        ]);


        $materia = new Materia();

        $materia->departamento = $request->departamento;
        $materia->carrera = $request->carrera;
        $materia->nombre = $request->nombre;
        $materia->codigo = $request->codigo;
        $materia->nivel = $request->nivel;
        $materia->cantGrupo = $request->cantGrupo;

        $materia->save();

        return redirect()->route('materia.reg');
    }

    public function editar(Materia $materia)
    {
        return view('materia.editar', compact('materia'));
    }

    public function update(Request $request, Materia $materia)
    {
        $materia->departamento = $request->departamento;
        $materia->carrera = $request->carrera;
        $materia->nombre = $request->nombre;
        $materia->codigo = $request->codigo;
        $materia->nivel = $request->nivel;
        $materia->cantGrupo = $request->cantGrupo;

        $materia->save();

        return redirect()->route('materia.reg');
    }
}
