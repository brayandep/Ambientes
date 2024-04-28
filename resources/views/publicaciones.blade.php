@extends('layoutes.plantilla')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                <a href="{{ route('publicacion.ver', $publicacion->id) }}">{{ $publicacion->titulo }}</a>
                    <div class="acciones-publicacion">
                    <a href="{{ route('eliminar.publicacion', ['id' => $publicacion->id]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');"><i class="fa fa-trash"></i></a>
                    
                    <button class="btn btn-primary btn-editar" onclick="abrirModalEdicion({{ $publicacion->id }})">
                        <i class="fa fa-edit"></i>
                    </button>
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
                <a href="{{ route('publicacion.ver', $publicacion->id) }}">{{ $publicacion->titulo }}</a>
                
                    <div class="acciones-publicacion">
                    <a href="{{ route('eliminar.publicacion', ['id' => $publicacion->id]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');"><i class="fa fa-trash"></i></a>
                    <button class="btn btn-primary btn-editar" data-id="{{ $publicacion->id }}">
                        <i class="fa fa-edit"></i>
                    </button>



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
        <!-- Modal para editar publicación -->
        <div id="modal-edicion" class="modal">
            <div class="modal-content">
                <span class="close" onclick="cerrarModalEdicion()">&times;</span>
                <h2>Editar Publicación</h2>
                <form id="formulario-edicion" method="POST" action="{{ route('actualizar.publicacion', $publicacion->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editar-tipo">Tipo:</label>
                        <select id="editar-tipo" class="form-control" name="tipo" required>
                            <option value="reglamento">Reglamento</option>
                            <option value="anuncio">Anuncio</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editar-titulo">Título:</label>
                        <input id="editar-titulo" type="text" class="form-control" name="titulo" required>
                    </div>

                    <div class="form-group">
                        <label for="editar-descripcion">Descripción:</label>
                        <textarea id="editar-descripcion" class="form-control" name="descripcion" required></textarea>
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
                        <button type="button" class="btn btn-secondary" onclick="cerrarModalEdicion()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtiene el botón de crear publicación
    var btnCrearPublicacion = document.getElementById('btn-crear-publicacion');
    var btnsEditarPublicacion = document.querySelectorAll('.btn-editar');

    // Agrega un event listener para el clic en el botón
    btnCrearPublicacion.addEventListener('click', function() {
        // Muestra el modal para crear publicación
        document.getElementById("formulario-crear-publicacion").style.display = "block";
    });

    // Agrega un event listener a cada botón de editar
    btnsEditarPublicacion.forEach(function(btnEditar) {
        btnEditar.addEventListener('click', function() {
            // Obtener la URL del enlace asociado al botón de editar
            var url = btnEditar.previousElementSibling.href;
            // Extraer el ID de la URL
            var publicacionId = obtenerIdDeUrl(url);
            // Mostrar el modal de edición
            document.getElementById("modal-edicion").style.display = "block";
            // Actualizar la acción del formulario con el ID específico
            var formularioEdicion = document.getElementById("formulario-edicion");
            formularioEdicion.action = "{{ url('/publicaciones') }}/" + publicacionId;
        });
    });
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

function cerrarModalEdicion() {
    // Cierra el modal de edición de publicación
    document.getElementById("modal-edicion").style.display = "none";
}

// Función para abrir el modal de edición y cargar los datos de la publicación
// Función para abrir el modal de edición y cargar los datos de la publicación
function abrirModalEdicion(id) {
    // Mostrar el modal de edición
    document.getElementById("modal-edicion").style.display = "block";

    // Obtener el formulario de edición
    var formularioEdicion = document.getElementById("formulario-edicion");

    // Actualizar la acción del formulario con el ID específico
    formularioEdicion.action = "{{ url('/publicaciones') }}/" + id;
}



document.getElementById('formulario-edicion').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el comportamiento predeterminado de enviar el formulario
    console.log('Formulario enviado');
    // Obtener los datos del formulario
    var formData = new FormData(this);

    // Enviar una solicitud AJAX al servidor
    fetch(this.action, {
        method: this.method,
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.ok) {
            // Si la respuesta es exitosa, cierra el modal
            cerrarModalEdicion();
            // Recargar la página o realizar otras acciones necesarias después de la actualización
            location.reload();
        } else {
            throw new Error('Error al actualizar la publicación');
        }
    })
    .catch(error => console.error('Error al actualizar la publicación:', error));
});


</script>

@endsection
