<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Unidades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .membrete {
            margin-bottom: 10px;
            border-bottom: 1px solid black;
            padding-bottom: 5px;
            font-size: 12px;
        }
        .membrete-table {
            width: 100%;
            border: none; /* Eliminar bordes de la tabla */
            margin-bottom: 5px;
        }
        .membrete-table td {
            padding: 0;
            vertical-align: middle;
            border: none; /* Eliminar bordes de la tabla */
        }
        .membrete img {
            max-width: 150px;
            vertical-align: middle;
        }
        .membrete-texto {
            padding-left: 5px; /* Espacio entre la imagen y el texto */
            vertical-align: middle;
        }
        .membrete-texto h1, .membrete-texto p {
            margin: 0; /* Eliminar márgenes */
        }
        .titulo {
            text-align: center;
            font-size: 13px;
        }
        .fecha {
            text-align: right;
            margin-top: 15px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .pagina {
            position: absolute;
            bottom: 0;
            right: 0;
            margin-bottom: 0px;
            margin-right: 15px;
            font-size: 14px;
        }

    </style>
</head>
<body>

<div class="membrete">
    <table class="membrete-table">
        <tr>
            <td>
                <img src="https://www.umss.edu.bo/wp-content/uploads/2022/08/Logo_umss.png" alt="Logo Universidad">
            </td>
            <td class="membrete-texto">
                <h1>Universidad Mayor de San Simón</h1>
                <p style="font-size: 16px;">Reportes</p>
            </td>
        </tr>
    </table>
</div>
<div class="titulo"> 
    <h1>Reporte de Reservas de Aulas</h1> 
</div>
<div class="fecha">
    <p>Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Aula</th>
            <th>Motivo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($solicitudes as $solicitud)
        <tr>
            <td>{{ $solicitud->estado }}</td>
            <td>{{ $solicitud->fecha }}</td>
            <td>{{ $solicitud->horario }}</td>
            <td>{{ $solicitud->nro_aula }}</td>
            <td>{{ $solicitud->motivo }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagina">
    <!-- Paginación -->
    <p>Página {{ $pageNumber }} de {{ $pageCount }}</p>
</div>

</body>
</html>
