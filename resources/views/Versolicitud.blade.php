<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
    <title>Lista de Solicitudes</title>
</head>
<body >
    <h2 class="titulo">Lista de Solicitudes</h2>
    <table class="centro" border="1">
        <thead>
            <tr class="colorcolumna">
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
            <tr class="contentcolumna">
                <td>{{ $solicitud->idsolicitud }}</td>
                <td>{{ $solicitud->usuario }}</td>
                <td>{{ $solicitud->nro_aula }}</td>
                <td>{{ $solicitud->motivo }}</td>
                <td>{{ $solicitud->fecha }}</td>
                <td>{{ $solicitud->horario }}</td>
                <td>
                    
                    <div class="botones-container">
                        <a  class="botonedit" href="{{ route('solicitud.edit', $solicitud->idsolicitud) }}">Modificar</a>
                        <form action="{{ route('solicitud.destroy', $solicitud->idsolicitud) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="botones" type="submit">Cancelar</button>
                        </form>
                    </div>
                   
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>

