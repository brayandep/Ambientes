<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Log;



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
            Log::create([
                'event_type' => 'Publicacion Creada',
                //'user_id' => Auth::id(),
                'new_data' => json_encode(['Publicaciones_id' => $publicacion->id]),
                'tabla_afectada' => 'publicaciones',
                'id_afectado' => $publicacion->id,
            ]);
        
        // Redireccionar al usuario con un mensaje de éxito
        return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido creada exitosamente.');
    }
    
    public function eliminarPublicacion($id) {
        
        $publicacion = Publicacion::find($id);
        // Registro de eliminacion en la bitácora
        Log::create([
            'event_type' => 'Publicación eliminada',
            //'user_id' => auth()->id(), // Obtener el ID del usuario autenticado
            'old_data' => json_encode($publicacion->toArray()),
            'tabla_afectada' => 'publicaciones',
            'id_afectado' => $publicacion->id,
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
/*
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
*/
public function editar($id)
{
    // Encuentra la publicación por su ID
    $publicacion = Publicacion::findOrFail($id);

    // Retorna la vista de edición con la publicación encontrada
    return view('editarPublicacion', compact('publicacion'));
}

public function actualizar(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'titulo' => 'required',
        'descripcion' => 'required',
        'archivo' => 'nullable|file',
        'fecha_vencimiento' => 'required|date|after_or_equal:today',
        'tipo' => 'required|in:reglamento,anuncio',
    ]);

    // Encuentra la publicación por su ID
    $publicacion = Publicacion::findOrFail($id);

    // Actualiza los campos de la publicación con los valores del formulario
    $publicacion->titulo = $request->titulo;
    $publicacion->descripcion = $request->descripcion;
    $publicacion->fecha_vencimiento = $request->fecha_vencimiento;
    $publicacion->tipo = $request->tipo;

    // Verifica si se ha enviado un nuevo archivo para actualizar
    if ($request->hasFile('archivo')) {
        // Elimina el archivo anterior si existe
        Storage::delete($publicacion->archivo);
        // Guarda el nuevo archivo y actualiza la ruta en la base de datos
        $publicacion->archivo = $request->file('archivo')->store('public/archivos');
    }

    // Guarda los cambios en la base de datos
    $publicacion->save();

    // Redirige al usuario con un mensaje de éxito
    return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido actualizada exitosamente.');
}
   

}
