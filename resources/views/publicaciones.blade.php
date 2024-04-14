@extends('layoutes.plantilla')
@section('contenido')
    <div class="container">
        <h1>Publicaciones</h1>

        <!-- Reglamentos -->
        <h2>Reglamentos</h2>
        <div class="publicaciones-list">
            @foreach($reglamentos as $publicacion)
                <div class="publicacion">
                    <span>{{ $publicacion->titulo }}</span>
                    <button class="btn btn-danger" onclick="eliminarPublicacion({{ $publicacion->id }})">Eliminar</button>
                    
                    <a href="{{ isset($publicacion->id) ? route('editar.publicacion', $publicacion->id) : '#' }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                </div>
            @endforeach
        </div>

        <!-- Anuncios -->
        <h2>Anuncios</h2>
        <div class="publicaciones-list">
            @foreach($anuncios as $publicacion)
                <div class="publicacion">
                    <span>{{ $publicacion->titulo }}</span>
                    <button class="btn btn-danger" onclick="eliminarPublicacion({{ $publicacion->id }})">Eliminar</button>
                    
                    <a href="{{ isset($publicacion->id) ? route('editar.publicacion', $publicacion->id) : '#' }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                </div>
            @endforeach
        </div>

        <!-- Botón para crear nueva publicación -->
        <button id="btn-crear-publicacion" class="btn btn-success">Crear Publicación</button>

    </div>
@endsection

@section('scripts')
<script>
    // Espera a que el documento esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Obtiene el botón de crear publicación
        var btnCrearPublicacion = document.getElementById('btn-crear-publicacion');

        // Agrega un event listener para el clic en el botón
        btnCrearPublicacion.addEventListener('click', function() {
            // Muestra el modal para crear publicación
            mostrarFormulario();
        });
    });

    function mostrarFormulario() {
        // Muestra el modal de creación de publicación
        document.getElementById("formulario-crear-publicacion").style.display = "block";
    }

    function eliminarPublicacion(id) {
        // Aquí puedes implementar la lógica para eliminar la publicación con el ID proporcionado
    }
</script>

@endsection
