<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnlaceGrupoDocente;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Http\Request;

class grupoController extends Controller
{
    public function create($materia)
    {   
        $mimateria = Materia::find($materia);
        $grupos = Grupo::where('idMateria', $materia)->get();
        $docentes = Docente::all();

        return view('materia.enlaceGrupo', compact('grupos', 'mimateria', 'docentes'));
    }

    public function jhosemar(Request $request, $cantgrupo)
    {

        foreach ($request->grupo_id as $index => $grupoId) {
            // Buscar el grupo por su ID
            $grupo = Grupo::find($grupoId);
    
            // Actualizar los datos del grupo con los valores enviados desde el formulario
            $grupo->numero = $request->numero[$index];
            $grupo->idDocente = $request->docente[$index];
            $grupo->idMateria = $request->materia[$index];
            // Puedes agregar más campos aquí si es necesario
    
            // Guardar los cambios en la base de datos
            $grupo->save();
        }
        return redirect()->route('materia.show');
    }
}