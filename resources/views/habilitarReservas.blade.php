@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
@endsection


@section('titulo', 'Formulario de Solicitud')


@section('contenido')
<div class="NavegacionContenido">
    <div class="navegacion">
    Inicio > Gestionar reservas > Ver solicitudes
    <h2 class="titulo">Visualizar solicitudes de reservas</h2>
    </div>
</div>
<div>
    <select class="input2" id="estado" name="estado" onchange="filtrarSolicitudes()">
        <option value="">Estado de solicitud</option>
        <option value="Sin confirmar">Sin confirmar</option>
        <option value="confirmado">Confirmado</option>
        <option value="denegado">Denegado</option>
    </select>
</div>

<table  id="tablaSolicitudes" class="centro" border="1">
    <thead>
        <tr class="colorcolumna">
            <th>Estado</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Aula</th>
            <th>Motivo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitudes as $solicitud)
        <tr class="contentcolumna"  data-estado="{{ $solicitud->estado }}">
            <td>{{ $solicitud->estado }}</td>
            <td>{{ $solicitud->fecha }}</td>
            <td>{{ $solicitud->horario }}</td>
            <td>{{ $solicitud->nro_aula }}</td>
            <td>{{ $solicitud->motivo }}</td>
            
            <td>
                
                <div class="botones-container">
                    <div>
                    <button><i class="fa-solid fa-circle-check"></i></button>
                    </div>
                    <div>
                    <button><i class="fa-solid fa-circle-xmark" ></i></button>
                    </div>
                    <div>
                    <button  type="submit" onclick="botonInfo()"><i class="fa-solid fa-circle-info"></i></button>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="modal-confirmacion" class="modal">
    <div class="modal-contenido">
        <p>aqui se debe visualizar la informacion del docente que reservo</p>
        <div class="botonesCentro">
            <button id="boton-salir"  class="botones" type="button" onclick="botonSalirClick()" >Salir</button>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function filtrarSolicitudes() {
        var seleccionado = document.getElementById("estado").value;
        var filas = document.querySelectorAll("#tablaSolicitudes tbody tr");
        
        filas.forEach(function(fila) {
            var estadoSolicitud = fila.getAttribute("data-estado");
            
            if (seleccionado === "" || estadoSolicitud === seleccionado) {
                fila.style.display = "table-row";
            } else {
                fila.style.display = "none";
            }
        });
    }
    function botonInfo() {
        var modal = document.getElementById("modal-confirmacion");
        modal.style.display = "block";
    }

    // Obtener el botón de salir del modal
    var botonSalir = document.getElementById("boton-salir");
    
    // Cuando se hace clic en el botón de salir, ocultar el modal
    function botonSalirClick() {
        var modal = document.getElementById("modal-confirmacion");
        modal.style.display = "none";
    }

</script>
@endsection






