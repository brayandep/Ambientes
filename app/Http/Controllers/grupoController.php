<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnlaceGrupoDocente;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class grupoController extends Controller
{
    public function create($materia)
    {   
        $mimateria = Materia::find($materia);
        $grupos = Grupo::where('idMateria', $materia)->get();
        $docentes = Docente::all();
        $usuarios = User::all();;
        return view('materia.enlaceGrupo', compact('grupos', 'mimateria', 'docentes','usuarios'));
    }

    public function jhosemar(Request $request)
{
    if(isset($request->docente) && is_array($request->docente)) {
        foreach ($request->docente as $index => $docenteId) {
            // Buscar el grupo por su índice
            $grupo = Grupo::find($index + 1);

            // Actualizar el ID del docente en el grupo
            $grupo->idDocente = $docenteId;
            
            // Guardar los cambios en la base de datos
            $grupo->save();
        }
    } else {
        // Manejar el caso en el que no se enviaron docentes
        // Por ejemplo, redirigiendo de nuevo al formulario con un mensaje de error
    }
    
    return redirect()->route('materia.show');
}


    
}
