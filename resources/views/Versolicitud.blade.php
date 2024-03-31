<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes</title>
</head>
<body>
    <h2>Lista de Solicitudes</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Usuario</th>
                <th>Número de Aula</th>
                <th>Motivo</th>
                <th>Fecha</th>
                <th>Horario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->idsolicitud }}</td>
                <td>{{ $solicitud->usuario }}</td>
                <td>{{ $solicitud->nro_aula }}</td>
                <td>{{ $solicitud->motivo }}</td>
                <td>{{ $solicitud->fecha }}</td>
                <td>{{ $solicitud->horario }}</td>
                <td>
                    
                    <a href="{{ route('solicitud.edit', $solicitud->idsolicitud) }}">Modificar</a>
                  
                    
                    <form action="#" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button action="{{ route('solicitud.destroy', $solicitud->idsolicitud) }}" method ="POST"type="submit">Eliminar</button>
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>

