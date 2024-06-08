@extends('layoutes.plantilla')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('links')
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
                        <a href="#" class="btn btn-primary" onclick='abrirFormularioEdicion(@json($publicacion))'><i class="fa fa-edit"></i></a>
                        <span style="color: #904368;padding: 20px;">Vencimiento: {{ \Carbon\Carbon::parse($publicacion->fecha_vencimiento)->format('d/m/Y') }}</span>
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
                        <a href="#" class="btn btn-primary" onclick='abrirFormularioEdicion(@json($publicacion))'><i class="fa fa-edit"></i></a>
                        <span style="color: #904368;padding: 20px;">Vencimiento: {{\Carbon\Carbon::parse($publicacion->fecha_vencimiento)->format('d/m/Y')}}</span>
                        <span>{{ $publicacion->visible ? 'Visible' : 'No visible' }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Botón para crear nueva publicación -->
        <button id="btn-crear-publicacion" class="btn btn-success">Crear Publicación</button>

        <!-- Modal para crear -->
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
                        <input id="archivo" type="file" class="form-control-file" name="archivo" accept=".pdf,.doc,.docx" required>
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

        <!-- Modal para editar -->
        <div id="formulario-editar-publicacion" class="modal">
            <div class="modal-content">
                <span class="close" onclick="cerrarFormularioEdicion()">&times;</span>
                <h2>Editar Publicación</h2>
                <form id="form-editar-publicacion" method="POST" action="" enctype="multipart/form-data">
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
                        <label for="editar-archivo">Archivo:</label>
                        <input id="editar-archivo" type="file" class="form-control-file" name="archivo" accept=".pdf,.doc,.docx">
                    </div>
                    <div class="form-group">
                        <label for="editar-fecha_vencimiento">Fecha de Vencimiento:</label>
                        <input id="editar-fecha_vencimiento" type="date" class="form-control" name="fecha_vencimiento" required>
                    </div>
                    <div class="botones">
                        <button type="button" class="btn btn-secondary" onclick="cerrarFormularioEdicion()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
var btnCrearPublicacion = document.getElementById('btn-crear-publicacion');

btnCrearPublicacion.addEventListener('click', function() {
    document.getElementById("formulario-crear-publicacion").style.display = "block";
});

function abrirFormularioEdicion(publicacion) {
    document.getElementById('editar-tipo').value = publicacion.tipo;
    document.getElementById('editar-titulo').value = publicacion.titulo;
    document.getElementById('editar-descripcion').value = publicacion.descripcion;
    document.getElementById('editar-fecha_vencimiento').value = publicacion.fecha_vencimiento;
    document.getElementById('form-editar-publicacion').action = '/publicaciones/' + publicacion.id;

    document.getElementById('formulario-editar-publicacion').style.display = "block";
}

function cerrarFormulario() {
    document.getElementById("formulario-crear-publicacion").style.display = "none";
}

function cerrarFormularioEdicion() {
    document.getElementById("formulario-editar-publicacion").style.display = "none";
}
</script>
@endsection
