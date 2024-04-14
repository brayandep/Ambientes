<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    public function index()
    {
        $reglamentos = Publicacion::where('tipo', 'reglamento')->get();
        $anuncios = Publicacion::where('tipo', 'anuncio')->get();
        return view('publicaciones', compact('reglamentos', 'anuncios'));
    }

    public function crear()
    {
        return view('modalPublicacion');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'nullable|file',
            'fecha_vencimiento' => 'required|date|after_or_equal:today',
            'tipo' => 'required|in:reglamento,anuncio',
        ]);

        // Crear una nueva instancia de Publicacion y asignar los valores del formulario
        $publicacion = new Publicacion();
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->archivo = $request->file('archivo')->store('archivos'); // Guardar el archivo en la carpeta 'archivos'
        $publicacion->fecha_vencimiento = $request->fecha_vencimiento;
        $publicacion->tipo = $request->tipo;
        $publicacion->save();

        // Redireccionar al usuario con un mensaje de éxito
        return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido creada exitosamente.');
    }
    public function editar($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        return view('modalPublicacion', compact('publicacion'));
    }

    public function destroy($id)
    {
        // Encontrar y eliminar la publicación con el ID proporcionado
        Publicacion::destroy($id);

        // Redireccionar al usuario con un mensaje de éxito
        return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido eliminada exitosamente.');
    }
}
