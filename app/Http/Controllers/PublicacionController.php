<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

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
        $messages = [
            'archivo.mimes' => 'El archivo debe ser un documento de tipo: pdf, doc, docx.',
        ];
        
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx',
            'fecha_vencimiento' => 'required|date|after_or_equal:today',
            'tipo' => 'required|in:reglamento,anuncio',
        ], $messages);

        // Crear una nueva instancia de Publicacion y asignar los valores del formulario
        $publicacion = new Publicacion();
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        
        if ($request->hasFile('archivo')) {
            $publicacion->archivo = $request->file('archivo')->store('public/archivos');
        }

        $publicacion->fecha_vencimiento = $request->fecha_vencimiento;
        $publicacion->tipo = $request->tipo;
        $publicacion->visible = 1;
        $publicacion->save();

        // Registro de creación en la bitácora
        Log::create([
            'event_type' => 'Publicacion Creada',
            'user_id' => Auth::id(),
            'new_data' => json_encode(['Publicaciones_id' => $publicacion->id]),
            'tabla_afectada' => 'publicaciones',
            'id_afectado' => $publicacion->id,
        ]);

        // Redireccionar al usuario con un mensaje de éxito
        return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido creada exitosamente.');
    }
    
    public function eliminarPublicacion($id)
    {
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            // Registro de eliminación en la bitácora
            Log::create([
                'event_type' => 'Publicación eliminada',
                'user_id' => auth()->id(), // Obtener el ID del usuario autenticado
                'old_data' => json_encode($publicacion->toArray()),
                'tabla_afectada' => 'publicaciones',
                'id_afectado' => $publicacion->id,
            ]);
            
            // Eliminar el archivo asociado
            Storage::delete($publicacion->archivo);

            Publicacion::destroy($id);

            return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada correctamente');
        }

        return redirect()->route('publicaciones.index')->with('error', 'Publicación no encontrada');
    }

    public function verArchivo($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $rutaArchivo = storage_path('app/' . $publicacion->archivo);

        if (file_exists($rutaArchivo)) {
            return response()->download($rutaArchivo, $publicacion->titulo, [
                'Content-Type' => mime_content_type($rutaArchivo),
                'Content-Disposition' => 'attachment; filename="' . $publicacion->titulo . '"',
                'Content-Length' => filesize($rutaArchivo),
                'X-Content-Type-Options' => 'nosniff'
            ]);
        }

        return redirect()->back()->with('error', 'El archivo no existe.');
    }


    public function actualizar(Request $request, $id)
    {
        $messages = [
            'archivo.mimes' => 'El archivo debe ser un documento de tipo: pdf, doc, docx.',
        ];

        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx',
            'fecha_vencimiento' => 'required|date',
            'tipo' => 'required|in:reglamento,anuncio',
        ], $messages);

        $publicacion = Publicacion::findOrFail($id);
        
        // Capturar datos originales antes de cualquier cambio
        $oldData = $publicacion->toArray();

        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->fecha_vencimiento = $request->fecha_vencimiento;
        $publicacion->tipo = $request->tipo;

        if ($request->hasFile('archivo')) {
            Storage::delete($publicacion->archivo);
            $publicacion->archivo = $request->file('archivo')->store('public/archivos');
        }
        if ($request->fecha_vencimiento < now()) {
            $publicacion->visible = 0;
        } else {
            $publicacion->visible = 1;
        }

        $publicacion->save();
//empieza guardado en bitacora de edicion
        // Obtener los datos nuevos después de la actualización
        $newData = $publicacion->fresh()->toArray();

        // Inicializar arrays para almacenar los campos que han cambiado
        $changedFields = [];
        $oldFields = [];

        // Definir los campos a excluir
        $excludedFields = ['created_at', 'updated_at'];

        // Comparar los datos antiguos con los nuevos, excluyendo los campos especificados
        foreach ($newData as $key => $value) {
            if (!in_array($key, $excludedFields) && array_key_exists($key, $oldData) && $value !== $oldData[$key]) {
                // Almacenar los campos que han cambiado
                $changedFields[$key] = $value;
                $oldFields[$key] = $oldData[$key];
            }
        }

        // Registro de edición en la bitácora
        Log::create([
            'event_type' => 'Publicacion editada',
            'user_id' => Auth::id(),
            'old_data' => json_encode($oldFields),
            //'new_data' => json_encode($changedFields),
            'tabla_afectada' => 'publicaciones',
            'id_afectado' => $publicacion->id,
        ]);

//termina guardado en bitacora edicion
        return redirect()->route('publicaciones.index')->with('success', 'La publicación ha sido actualizada exitosamente.');
    }
    
    // Método update que llama al método actualizar
    public function update(Request $request, $id)
    {
        return $this->actualizar($request, $id);
    }
}
