<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Solicitudes</title>
</head>
<body>
    <h2>Tabla de Solicitudes</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Aula</th>
                <th>Motivo</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id }}</td>
                    <td>{{ $solicitud->nro_aula }}</td>
                    <td>{{ $solicitud->motivo }}</td>
                    <td>{{ $solicitud->fecha }}</td>
                    <td>
                        <a href="{{ route('solicitudes.edit', $solicitud->id) }}">Modificar</a>
                        <form action="{{ route('solicitudes.destroy', $solicitud->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>