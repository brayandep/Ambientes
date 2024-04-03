<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrarMateria;
use App\Models\Materia;
use Illuminate\Http\Request;

class materiaController extends Controller
{
    public function show()
    {
        $materias = Materia::orderBy('id', 'desc')->paginate();
        
        return view('materia.lista', compact('materias'));
    }

    public function create()
    {
        return view('materia.registrar');
    }

    public function store(RegistrarMateria $request)
    {
        $materia = Materia::create($request->all());

        return redirect()->route('materia.show');
    }

    public function editar(Materia $materia)
    {
        return view('materia.editar', compact('materia'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'departamento' => 'required',
            'carrera' => 'required',
            'nombre' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'codigo' => 'required|digits:6|numeric',
            'nivel' => 'required',
            'cantGrupo' => 'required'
        ],
        [
            'cantGrupo.required' => 'El grupo es requerido'
        ]);
        
        $materia->update($request->all());

        return redirect()->route('materia.show');
    }
}
