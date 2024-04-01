<a href="{{ route('registro.create') }}">Crear</a>

@foreach ($ambientes as $ambiente)
    <p>{{ $ambiente->nombre }}</p>

    <a href="{{ route('registro.edit', $ambiente->id) }}" class="btn btn-primary">Editar</a>

    <form method="POST" action="{{ route('registro.destroy', $ambiente->id) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
@endforeach


