@extends('layoutes.plantilla')
@section('contenido')
<style>
    .container {
        margin: 20px; /* Agregar un margen de 20px alrededor de toda la página */
    }
#titulo-log {
        font-size: 24px; /* Tamaño de fuente más grande */
        font-weight: bold; /* Texto en negrita */
        margin-bottom: 15px;
    }
table {
    border-collapse: collapse;
    width: 100%;
    margin: 10px; 
   /* overflow-x: auto;
    white-space: nowrap;*/
}

/* Estilo para las celdas de la tabla */
th, td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    max-width: 500px; 
    word-wrap: break-word;
}

/* Estilo para las filas impares */
tr:nth-child(odd) {
    background-color: #f2f2f2;
}

/* Estilo para el encabezado de la tabla */
th {
    background-color: #933864;
    color: white;
}

/* Estilo para las celdas que contienen los datos antiguos y nuevos */
.old-data, .new-data {
    max-height: 100px; /* Altura máxima de la celda */
    overflow-y: auto; /* Permitir desplazamiento vertical si el contenido es demasiado largo */
}
</style>

<div class="container">
            
        <div class="pagination">
            {{ $logs->links() }}
        </div>


        <h1 id="titulo-log">Registros de Log</h1>

            <table>
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Operación</th>
                        <th>Datos Antiguos</th>
                        <th>Datos Nuevos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->event_type }}</td>
                            <td>{{ $log->user ? $log->user->name : 'Anónimo' }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $log->operation }}</td>
                            <td>{{ $log->old_data }}</td>
                            <td>{{ $log->new_data }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
            {{ $logs->links() }}
            </div>
            </div>
</div>
@endsection
