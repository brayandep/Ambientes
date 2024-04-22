@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/styleVerAmbientes.css') }}">
@endsection


@section('titulo', 'Formulario de Solicitud')


@section('contenido')
<div class="NavegacionContenido">
    <div class="navegacion">
    Inicio > Gestionar mis solicitudes > Ver mis solicitudes
    <h2 class="titulo">Lista de Solicitudes</h2>
    </div>
</div>
<div class="contenidoF">
    <div class="F">
        <select class="input2" id="usuario" name="usuario"  onchange="filtrarSolicitudes()">
            <option>Selecciona un usuario </option>
            @foreach($usuarios as $usuario)
            <option value="{{ $usuario->nombre}}" {{ isset($nombre) ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
            @endforeach
            
        </select>
    </div>
</div>

<table  id="tablaSolicitudes" class="centro" border="1">
    <thead>
        <tr class="colorcolumna">
            <th>Nro</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Número de Aula</th>
            <th>Motivo</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitudes as $solicitud)
        <tr class="contentcolumna" data-usuario="{{ $solicitud->usuario }}">
            <td>{{ $solicitud->idsolicitud }}</td>
            <td>{{ $solicitud->usuario }}</td>
            <td>{{ $solicitud->estado }}</td>
            <td>{{ $solicitud->nro_aula }}</td>
            <td>{{ $solicitud->motivo }}</td>
            <td>{{ $solicitud->fecha }}</td>
            <td>{{ $solicitud->horario }}</td>
            <td>
                
                <div class="botones-container">
                    @if($solicitud->estado == 'Sin confirmar')
                        <a  class="botonedit" href="{{ route('solicitud.edit', $solicitud->idsolicitud) }}">Modificar</a>
                        <button  id="boton-cancelar" class="botones" type="submit" onclick="botonCancelar()" >Suspender</button>
                        <div id="modal-confirmacion" class="modal">
                
                            <div class="modal-contenido">
                                <p>¿Está seguro de que desea suspender la reserva?</p>
                                <div class="botonesCentro">
                                    <button id="boton-confirmar"  class="botones" type="button" onclick="botonSalirClick()" >Salir</button>
                                    <form action="{{ route('solicitud.suspender', $solicitud->idsolicitud) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button id="boton-salir"  class="botones" type="submit">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @elseif($solicitud->estado == 'confirmado')   
                        <button  id="boton-cancelar" class="botones" type="submit" onclick="botonCancelar()" >Suspender</button>
                        <div id="modal-confirmacion" class="modal">
                
                            <div class="modal-contenido">
                                <p>¿Está seguro de que desea suspender la reserva?</p>
                                <div class="botonesCentro">
                                    <button id="boton-confirmar"  class="botones" type="button" onclick="botonSalirClick()" >Salir</button>
                                    <form action="{{ route('solicitud.suspender', $solicitud->idsolicitud) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <button id="boton-salir"  class="botones" type="submit">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @elseif($solicitud->estado == 'denegado')                       
                    @elseif($solicitud->estado == 'suspendido')
                        <a  class="botonedit" href="{{ route('solicitud.store') }}">Nueva solicitud</a>
                    @endif
                        
                </div>
               
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    function filtrarSolicitudes() {
        var seleccionado = document.getElementById("usuario").value;
        var filas = document.querySelectorAll("#tablaSolicitudes tbody tr");
        
        filas.forEach(function(fila) {
            if (fila.getAttribute("data-usuario") === seleccionado || seleccionado === "Selecciona un usuario") {
                fila.style.display = "table-row";
            } else {
                fila.style.display = "none";
            }
        });
    }

    function botonCancelar() {
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





