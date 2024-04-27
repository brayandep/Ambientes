<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;



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
        $publicacion->archivo = $request->file('archivo')->store('public/archivos');
        $publicacion->fecha_vencimiento = $request->fecha_vencimiento;
        $publicacion->tipo = $request->tipo;
        $publicacion->visible = 1;
        $publicacion->save();

        // Redireccionar al usuario con un mensaje de éxito
        return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido creada exitosamente.');
    }
    
    public function eliminarPublicacion($id) {
        // Encuentra y elimina la publicación con el ID proporcionado
        Publicacion::destroy($id);
    
        // Redirige a la página de publicaciones o a donde sea apropiado después de eliminar
        return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada correctamente');
    }
    



    /*public function editar($id)
    {
       $publicacion = Publicacion::findOrFail($id);
        return view('modalPublicacion', compact('publicacion'));
   }*/
    public function obtenerDetalles($id)
    {
        // Encuentra la publicación por su ID
        $publicacion = Publicacion::findOrFail($id);

        // Devuelve los detalles de la publicación en formato JSON
        return response()->json($publicacion);
    }
   

    public function verArchivo($id)
{
    // Encuentra la publicación por su ID
    $publicacion = Publicacion::findOrFail($id);

    // Obtén la ruta completa del archivo
    $rutaArchivo = storage_path('app/' . $publicacion->archivo);

    // Verifica si el archivo existe
    if (file_exists($rutaArchivo)) {
        // Retorna una respuesta de descarga del archivo
        return Response::download($rutaArchivo, $publicacion->titulo);
    } else {
        // Si el archivo no existe, redirecciona con un mensaje de error
        return redirect()->back()->with('error', 'El archivo no existe.');
    }
}

    
}
