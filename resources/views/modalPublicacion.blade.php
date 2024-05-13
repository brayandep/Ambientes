@section('links')
    <link rel="stylesheet" href="{{ asset('css/stylePublicacion.css') }}">

@endsection
<div id="formulario-crear-publicacion" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarFormulario()">&times;</span>
        @if(isset($publicacion))
            <h2>Editar Publicación</h2>
            <form method="POST" action="{{ route('actualizar.publicacion', $publicacion->id) }}" enctype="multipart/form-data">
            @method('PUT')
        @else
            <h2>Crear Publicación</h2>
            <form method="POST" action="{{ route('guardar.publicacion') }}" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" class="form-control" name="tipo" required>
                    <option value="reglamento" {{ (isset($publicacion) && $publicacion->tipo == 'reglamento') ? 'selected' : '' }}>Reglamento</option>
                    <option value="anuncio" {{ (isset($publicacion) && $publicacion->tipo == 'anuncio') ? 'selected' : '' }}>Anuncio</option>
                </select>
            </div>

            <div class="form-group">
                <label for="titulo">Título:</label>
                <input id="titulo" type="text" class="form-control" name="titulo" value="{{ isset($publicacion) ? $publicacion->titulo : '' }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" class="form-control" name="descripcion" required>{{ isset($publicacion) ? $publicacion->descripcion : '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="archivo">Archivo:</label>
                <input id="archivo" type="file" class="form-control-file" name="archivo" {{ isset($publicacion) ? '' : 'required' }}>
            </div>

            <div class="form-group">
                <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                <input id="fecha_vencimiento" type="date" class="form-control" name="fecha_vencimiento" min="{{ now()->format('Y-m-d') }}" value="{{ isset($publicacion) ? $publicacion->fecha_vencimiento : '' }}" required>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($publicacion) ? 'Actualizar' : 'Aceptar' }}</button>
            <button type="button" class="btn btn-secondary" onclick="cerrarFormulario()">Cancelar</button>
        </form>
    </div>
</div>
