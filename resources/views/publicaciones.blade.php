@extends('layoutes.plantilla')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('links')
    <!-- <link rel="stylesheet" href="{{ asset('css/stylePublicacion.css') }}"> -->
    <link rel="stylesheet" href="../../css/stylePublicacion.css">
@endsection

@section('contenido')
    <div class="container">
        <h1><i class="fas fa-clipboard" style="margin-bottom: 40px;"></i> Publicaciones</h1>
        <!-- Reglamentos -->
        <h2>Reglamentos</h2>
        <div class="publicaciones-list">
            @foreach($reglamentos as $publicacion)
                <div class="publicacion">
                    
                <a href="{{ route('publicacion.ver', $publicacion->id) }}" style="color: blue;">{{ $publicacion->titulo }}</a>
                    <div class="acciones-publicacion">
                        <a href="{{ route('eliminar.publicacion', ['id' => $publicacion->id]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');"><i class="fa fa-trash"></i></a>
                        <span style="color: #904368;">Vencimiento: {{ $publicacion->fecha_vencimiento }}</span>

                        <span>{{ $publicacion->visible ? 'Visible' : 'No visible' }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Anuncios -->
        <h2>Anuncios</h2>
        <div class="publicaciones-list">
            @foreach($anuncios as $publicacion)
                <div class="publicacion">
                <a href="{{ route('publicacion.ver', $publicacion->id) }}" style="color: blue;">{{ $publicacion->titulo }}</a>
                    <div class="acciones-publicacion">
                        <a href="{{ route('eliminar.publicacion', ['id' => $publicacion->id]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');"><i class="fa fa-trash"></i></a>
                        <span style="color: #904368;">Vencimiento: {{ $publicacion->fecha_vencimiento }}</span>
                        <span>{{ $publicacion->visible ? 'Visible' : 'No visible' }}</span> 
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Botón para crear nueva publicación -->
        <button id="btn-crear-publicacion" class="btn btn-success">Crear Publicación</button>


        <!-- Modal para crear-->
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
// Obtiene el botón de crear publicación
var btnCrearPublicacion = document.getElementById('btn-crear-publicacion');

// Agrega un event listener para el clic en el botón
btnCrearPublicacion.addEventListener('click', function() {
    // Muestra el modal para crear publicación
    document.getElementById("formulario-crear-publicacion").style.display = "block";
});

// Función para extraer el ID de la URL
function obtenerIdDeUrl(url) {
    // Dividir la URL por "/"
    var partes = url.split("/");
    // El ID es el último elemento de la URL
    var id = partes[partes.length - 2];
    return id;
}

function cerrarFormulario() {
    // Cierra el modal de creación de publicación
    document.getElementById("formulario-crear-publicacion").style.display = "none";
}
</script>

@endsection
