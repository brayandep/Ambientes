@extends('layoutes.plantilla')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/stylePublicacion.css') }}">
@endsection

@section('contenido')
    <div class="container">
        <h1><i class="fas fa-clipboard" style="margin-bottom: 40px;"></i> Publicaciones</h1>
        <!-- Reglamentos -->
        <h2>Reglamentos</h2>
        <div class="publicaciones-list">
            @foreach($reglamentos as $publicacion)
                <div class="publicacion">
                    
                    <span>{{ $publicacion->titulo }}</span>
                    
                    <div class="acciones-publicacion">
                    
                    <a href="{{ route('eliminar.publicacion', ['id' => $publicacion->id_publicaciones]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');"><i class="fa fa-trash"></i></a>

                        <a href="{{ isset($publicacion->id) ? route('editar.publicacion', $publicacion->id) : '#' }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <span>{{ $publicacion->visible ? 'Visible' : 'No visible' }}</span> <!-- Nueva columna -->
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Anuncios -->
        <h2>Anuncios</h2>
        <div class="publicaciones-list">
            @foreach($anuncios as $publicacion)
                <div class="publicacion">
                    
                    <span>{{ $publicacion->titulo }}</span>
                    <div class="acciones-publicacion">
                    <a href="{{ route('eliminar.publicacion', ['id' => $publicacion->id_publicaciones]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');"><i class="fa fa-trash"></i></a>
                        <a href="{{ isset($publicacion->id) ? route('editar.publicacion', $publicacion->id) : '#' }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <span>{{ $publicacion->visible ? 'Visible' : 'No visible' }}</span> <!-- Nueva columna -->
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Botón para crear nueva publicación -->
        <button id="btn-crear-publicacion" class="btn btn-success">Crear Publicación</button>


        <!-- Modal para crear/editar publicación -->
        <div id="formulario-crear-publicacion" class="modal">
            <div class="modal-content">
                <span class="close" onclick="cerrarFormulario()">&times;</span>
                <h2>Crear Publicación</h2>
                <form method="POST" action="{{ route('guardar.publicacion') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" class="form-control" name="tipo" required>
                            <option value="reglamento">Reglamento</option>
                            <option value="anuncio">Anuncio</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input id="titulo" type="text" class="form-control" name="titulo" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" class="form-control" name="descripcion" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="archivo">Archivo:</label>
                        <input id="archivo" type="file" class="form-control-file" name="archivo" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                        <input id="fecha_vencimiento" type="date" class="form-control" name="fecha_vencimiento" min="{{ now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="botones">
                        <button type="button" class="btn btn-secondary" onclick="cerrarFormulario()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                   
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
<script>
// para el modal
        // Espera a que el documento esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Obtiene el botón de crear publicación
        var btnCrearPublicacion = document.getElementById('btn-crear-publicacion');

        // Agrega un event listener para el clic en el botón
        btnCrearPublicacion.addEventListener('click', function() {
            // Muestra el modal para crear publicación
            document.getElementById("formulario-crear-publicacion").style.display = "block";
        });
    });
    function cerrarFormulario() {
        // Cierra el modal de creación de publicación
        document.getElementById("formulario-crear-publicacion").style.display = "none";
    }
    // termina para el modal
    function eliminarPublicacion(id) {
        // Aquí puedes implementar la lógica para eliminar la publicación con el ID proporcionado
    }

</script>

@endsection
