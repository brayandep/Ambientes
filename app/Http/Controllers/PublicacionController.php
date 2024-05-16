<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Log;
use App\Utils\Logger;



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
        // Registro de creación en la bitácora
        /*Log::create([
            'event_type' => 'Publicación creada',
            //'user_id' => auth()->id(), // Obtener el ID del usuario autenticado
            'new_data' => json_encode($publicacion->toArray()),
            'operation' => 'Crear',
        ]);*/
        $new_data = json_encode($publicacion->toArray());
        Logger::logCreation('Publicación creada', $new_data);
        
        // Redireccionar al usuario con un mensaje de éxito
        return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido creada exitosamente.');
    }
    
    public function eliminarPublicacion($id) {
        // Encuentra y elimina la publicación con el ID proporcionado
        
        $publicacion = Publicacion::find($id);
        Log::create([
            'event_type' => 'Publicación eliminada',
            //'user_id' => auth()->id(), // Obtener el ID del usuario autenticado
            'old_data' => json_encode($publicacion->toArray()),
            'operation' => 'Eliminar',
        ]);
        Publicacion::destroy($id);
        // Redirige a la página de publicaciones o a donde sea apropiado después de eliminar
        return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada correctamente');
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
public function update(Request $request, $id)
    {
        // Encuentra la publicación por su ID
        $publicacion = Publicacion::findOrFail($id);

        // Valida los datos del formulario de edición
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'nullable|file',
            'fecha_vencimiento' => 'required|date|after_or_equal:today',
            'tipo' => 'required|in:reglamento,anuncio',
        ]);

        // Actualiza los datos de la publicación con los valores del formulario
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->fecha_vencimiento = $request->fecha_vencimiento;
        $publicacion->tipo = $request->tipo;

        // Si se proporciona un nuevo archivo, actualiza el archivo de la publicación
        if ($request->hasFile('archivo')) {
            $publicacion->archivo = $request->file('archivo')->store('public/archivos');
        }

        // Guarda los cambios en la base de datos
        $publicacion->save();

        // Redirecciona a la página de publicaciones o a donde sea apropiado después de actualizar
        return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido actualizada exitosamente.');
    }
    public function edit($id)
{
    // Encuentra la publicación por su ID
    $publicacion = Publicacion::findOrFail($id);

    // Retorna la vista del formulario de edición con los detalles de la publicación creo que borramos
    return view('formularioEditarPublicacion', compact('publicacion'));
}

    
}
