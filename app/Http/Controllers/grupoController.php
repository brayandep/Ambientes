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

    public function jhosemar(Request $request, $cantgrupo)
    {

        foreach ($request->grupo_id as $index => $grupoId) {
            // Buscar el grupo por su ID
            $grupo = Grupo::find($grupoId);
    
            // Actualizar los datos del grupo con los valores enviados desde el formulario
            $grupo->nombre = $request->nombre[$index];
            $grupo->docente = $request->docente[$index];
            $grupo->materia = $request->materia[$index];
            // Puedes agregar más campos aquí si es necesario
    
            // Guardar los cambios en la base de datos
            $grupo->save();
        }
    

        // for ($i = 0; $i < $cantgrupo; $i++) {
            
            
        //     $request = new Grupo();
        //     $request->materia.$i = '';
        //     $request->nombre.$i = 1;
        //     $request->docente.$i = $materia->id;
        //     $request->save();
        // }

        return redirect()->route('materia.show');
    }
}
