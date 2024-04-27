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
        {{-- <select class="input2" id="usuario" name="usuario"  onchange="filtrarSolicitudes()">
            <option>Selecciona un usuario </option>
            @foreach($usuarios as $usuario)
            <option value="{{ $usuario->nombre}}" {{ isset($nombre) ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
            @endforeach
            
        </select> --}}
    </div>
</div>

<table  id="tablaSolicitudes" class="centro">
    <thead>
        <tr class="colorcolumna">
           
            <th ><div class="contBotones">
                <button class="nomCol">Nro</button>
            </div></th>
            <th><div class="contBotones">
                <button class="nomCol">Usuario</button>
            </div></th>
            <th><div class="contBotones">
                <button class="nomCol">Estado</button>
            </div></th>
            <th><div class="contBotones">
                <button class="nomCol">Nro de Aula</button>
            </div></th>
            <th><div class="contBotones">
                <button class="nomCol">Motivo</button>
            </div></th>
            <th><div class="contBotones">
                <button class="nomCol">Fecha</button>
            </div></th>
            <th><div class="contBotones">
                <button class="nomCol">Horario</button>
            </div></th>
            <th><div class="contBotones">
                <button class="nomCol">Fecha de solicitud</button>
            </div></th>
            <th id="accionCol"><div class="contBotones">
                <button class="nomCol">Acciones</button>
            </div></th>
        </tr>
    </thead>
    <tbody class="cuerpo">
        @foreach($solicitudes as $solicitud)
        @php
        $fechaCreacion = \Carbon\Carbon::parse($solicitud->created_at);
        $fechaLimiteSuspension = $fechaCreacion->addDay(); // Calcula la fecha límite de suspensión
        $fechaHoy = \Carbon\Carbon::now();
        @endphp
        <tr class="contentcolumna" data-usuario="{{ $solicitud->usuario }}">
            <td>{{ $solicitud->idsolicitud }}</td>
            <td>{{ $solicitud->usuario }}</td>
            <td>{{ $solicitud->estado }}</td>
            <td>@foreach($ambientes as $ambiente)
                @if($solicitud->nro_aula == $ambiente->id)
                    {{ $ambiente->nombre }}
                @endif
            @endforeach</td>
            <td>{{ $solicitud->motivo }}</td>
            <td>{{ $solicitud->fecha }}</td>
            <td>{{ $solicitud->horario }}</td>
            <td>{{ $solicitud->created_at }}</td>
            <td>
                
                <div class="botones-container">
                    @if($solicitud->estado == 'Sin confirmar')

                   
                  
                    @if($fechaHoy->lte($fechaLimiteSuspension))
                      <!-- Muestra el botón de suspender solo si ha pasado menos de un día desde la creación de la solicitud -->
                         <form action="{{ route('solicitud.suspender', $solicitud->idsolicitud) }}" method="POST">
                         @csrf
                        @method('put')
                        <button  id="boton-cancelar" class="botones" type="submit" onclick="botonCancelar()" >Suspender</button>     
                         </form>
                      @endif
                    
                        <a  class="botonedit" href="{{ route('solicitud.edit', $solicitud->idsolicitud) }}">Modificar</a>
                        


                        
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
                    <p>Sin acciones</p>            
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





