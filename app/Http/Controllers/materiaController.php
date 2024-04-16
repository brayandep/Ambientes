<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrarMateria;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Unidad;
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
        $departamentos = Unidad::where('nivel', '3')->get();

        return view('materia.registrar', compact('departamentos'));
    }

    public function store(RegistrarMateria $request)
    {
        $materia = Materia::create($request->all());

        for ($i = 0; $i < $materia->cantGrupo; $i++) {
            $grupo = new Grupo();
            $grupo->nombre = $i+1;
            $grupo->docente = '';
            $grupo->materia = $materia->id;
            $grupo->save();
        }

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

        $grupoE = new Grupo();
        $grupoE = Grupo::where('materia', $materia->id)->delete();
        for ($i = 0; $i < $materia->cantGrupo; $i++) {
            $grupo = new Grupo();
            $grupo->nombre = $i+1;
            $grupo->docente = '';
            $grupo->materia = $materia->id;
            $grupo->save();
        }


        return redirect()->route('materia.show');
    }
}
