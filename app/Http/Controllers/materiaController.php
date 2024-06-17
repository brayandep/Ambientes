<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrarMateria;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Unidad;
use Illuminate\Http\Request;

use PDF;

class materiaController extends Controller
{
    public function show()
    {
        $materias = Materia::orderBy('id', 'desc')->paginate();
        
        return view('materia.lista', compact('materias'));
    }

    public function create()
    {
        $departamentos = Unidad::where('nivel', '3')->where('UnidadHabilitada','1')->get();

        return view('materia.registrar', compact('departamentos'));
    }

    public function store(RegistrarMateria $request)
    {
        $materia = Materia::create($request->all());
        for ($i = 0; $i < $materia->cantGrupo; $i++) {
            $grupo = new Grupo();
            $grupo->numero = $i+1;
            $grupo->idDocente = null;
            $grupo->idMateria = $materia->id;
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
            'nombre' => 'required|max:100|regex:/^[a-zA-Z\s]+$/|unique:materia,nombre, '. $materia -> id,
            'codigo' => 'required|digits:6|numeric',
            'nivel' => 'required',
            'cantGrupo' => 'required'
        ],
        [
            'cantGrupo.required' => 'El grupo es requerido'
        ]);
        
        $materia->update($request->all());

        $grupoE = new Grupo();
        $grupoE = Grupo::where('idMateria', $materia->id)->delete();
        for ($i = 0; $i < $materia->cantGrupo; $i++) {
            $grupo = new Grupo();
            $grupo->numero = $i+1;
            $grupo->idDocente = null;
            $grupo->idMateria = $materia->id;
            $grupo->save();
        }


        return redirect()->route('materia.show');
    }

    public function estado(Materia $materia)
    {
        // Cambiar el estado de 1 a 0 y viceversa
        $materia->estado = $materia->estado == 1 ? 0 : 1;
        
        $materia->save();

        return redirect()->back()->with('success', 'Estado del materia actualizado correctamente');
    }

    public function descargarMateriasPDF(){
        $materias = Materia::all(); // Obtén todas las materias
        // Invertir el orden de las materias
        $materias = $materias->reverse();

        return view('pdf.materias',compact('materias'));
    }
}
