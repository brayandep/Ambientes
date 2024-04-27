<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ambientes</title>
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
            border: none; 
            margin-bottom: 5px;
        }
        .membrete-table td {
            padding: 0;
            vertical-align: middle;
            border: none; 
        }
        .membrete img {
            max-width: 150px;
            vertical-align: middle;
        }
        .membrete-texto {
            padding-left: 5px; 
            vertical-align: middle;
        }
        .membrete-texto h1, .membrete-texto p {
            margin: 0; 
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
                <img src="http://www.drei.umss.edu.bo/img/umss-horizontal.png" alt="Logo Universidad">
            </td>
            <td class="membrete-texto">
                <h1>Universidad Mayor de San Simón</h1>
                <p style="font-size: 16px;">Reportes</p>
            </td>
        </tr>
    </table>
</div>
<div class="titulo"> 
    <h1>Reporte de Ambientes registrados</h1> 
</div>
<div class="fecha">
    <p>Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Unidad</th>
            <th>Nombre</th>
            <th>Capacidad</th>
            <th>Ubicación</th>
            <th>Descripción</th>
            <th>Estado</th>
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
            <td>{{ $ambiente->descripcion_ubicacion}}</td>
            <td>
                @if ($ambiente->estadoAmbiente == 1)
                    Habilitado
                @else
                    Deshabilitado
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>Administrador: Esteban Rodriguez Arce</p>
<div class="pagina">
    <!-- Paginación -->
    <p>Página {{ $pageNumber }} de {{ $pageCount }}</p>
</div>

</body>
</html>
