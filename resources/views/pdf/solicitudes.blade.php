<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Solicitud de Aulas</title>
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
        input[type="submit"] {
            background-color: #4e798c;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .cancelar {
            background-color: #F35D5D;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .botones-imprimir {
            text-align: right;
        }

        /* Estilo para la impresión */
        @media print {
            .no-imprimir {
                display: none;
            }
        }

    </style>
</head>
<body>

<div class="membrete">
    <table class="membrete-table">
        <tr>
            <td>
                <img src="http://www.drei.umss.edu.bo/img/umss-horizontal.png" alt="Logo Universidad">
                <!--<img src="{{asset('images\Logo_umss.png')}}" alt="Logo Universidad"> -->
            </td>
            <td class="membrete-texto">
                <h1>Universidad Mayor de San Simón</h1>
                <p style="font-size: 16px;">Reportes</p>
            </td>
        </tr>
    </table>
</div>
<div class="titulo"> 
    <h1>Reporte de Solicitud de Aulas</h1> 
</div>
<div class="fecha">
    <p>Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
</div>
<div class="botones-imprimir">
    <input type="submit" value="Imprimir" onclick="imprimirBoleta()" id="botonImprimir">
    <input type="button" value="Cerrar" onclick="confirmarCancelacion()" class="cancelar">
</div>

<table>
    <thead>
        <tr>
            <th>Orden de llegada</th>
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
            <td>{{ \Carbon\Carbon::parse($solicitud->created_at)->format('d/m/Y H:i') }}</td>
            <td>{{ $solicitud->estado }}</td>
            <td>{{ $solicitud->fecha }}</td>
            <td>{{ $solicitud->horario }}</td>
            <td>
                @foreach($ambientes as $ambiente)
                    @if($solicitud->nro_aula == $ambiente->id)
                        {{ $ambiente->nombre }}
                    @endif
                @endforeach
            </td>
            <td>{{ $solicitud->motivo }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>Administrador: Esteban Rodriguez Arce</p>

<script>
    function imprimirBoleta() {
            // Oculta los botones al imprimir

            document.querySelector('.botones-imprimir').style.display = 'none';
            window.print();

            // Muestra los botones después de un segundo
            setTimeout(function() {
                document.querySelector('.botones-imprimir').style.display = 'block';
            }, 1000);
        }

    function confirmarCancelacion() {
        // Aquí puedes redirigir o cerrar la ventana como lo necesites
        window.close();
    }
</script>
</body>
</html>
