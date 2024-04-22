<!-- resources/views/pdf/ambientes.blade.php -->

<h1>Lista de Ambientes</h1>

<table border="1">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Unidad</th>
            <th>Nombre</th>
            <th>Capacidad</th>
            <th>Ubicación</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ambientes as $ambiente)
            <tr>
                <td>{{ $ambiente->codigo }}</td>
                <td>{{ $ambiente->unidad }}</td>
                <td>{{ $ambiente->nombre }}</td>
                <td>{{ $ambiente->capacidad }}</td>
                <td>{{ $ambiente->ubicacion }}</td>
                <td>{{ $ambiente->descripcion_ubicacion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
