<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Solicitud;
use App\Models\Models\Usuario;
class SolicitudController extends Controller
{
    public function index()
    {
        return view('SolicitudAmbiente');
    }

    public function store(Request $request)
    {
        $request->validate([
           
            'nro_aula' => 'required',
            'materia' => 'required',
            'grupo' => 'required',
            'motivo' => 'required',
            'fecha' => 'required|date',
            'horario' => 'required',
        ]);

        Solicitud::create($request->all());

        return redirect('/')->with('success', 'Solicitud creada exitosamente.');

}
public function create()
{
    $usuarios = Usuario::all(['nombre']); // Solo recuperamos el nombre de los usuarios
    return view('SolicitudAmbiente', ['usuarios' => $usuarios]);
}
}