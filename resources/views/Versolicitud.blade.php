@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="../../css/stylesbrayan.css">
<link rel="stylesheet" type="text/css" href="../../css/styleVerAmbientes.css">
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
      
    </div>
</div>

<table  id="tablaSolicitudes" class="centro">
    <thead>
        <tr class="colorcolumna">
           
            <th ><div class="contBotones">
                <button class="nomCol">Nro</button>
            </div></th>
            {{-- <th><div class="contBotones">
                <button class="nomCol">Usuario</button>
            </div></th> --}}
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
            {{-- <td>
                @foreach($usuarios as $usuario2)
                    @if($solicitud->usuario == $usuario2->id)
                        {{ $usuario2->nombre }}
                    @endif
                @endforeach
            </td> --}}
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
                        <button   class="fa-solid fa-circle-xmark" type="submit" onclick="botonCancelar()" ></button>     
                         </form>
                      @endif
                    
                        <a  class="fa-solid fa-pen-to-square" href="{{ route('solicitud.edit', $solicitud->idsolicitud) }}"></a>
                        


                        
                    @elseif($solicitud->estado == 'confirmado')   
                    <a  >Sin acciones </a>
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





