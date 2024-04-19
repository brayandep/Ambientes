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
<div class="contenidoFyR">
    <div class="FiltroyReporte">
        <div>
           <form action="{{route('solicitud.mostrar')}}" method="get" id="solicitudEstado">
                @csrf
                <select class="input2" id="estado" name="estado" onchange="filtrarSolicitudes()">
                    <option value="todos"{{ request('estado') == 'todos' ? 'selected' : '' }}>Todos</option>
                    <option value="Sin confirmar" {{ request('estado') == 'Sin confirmar' ? 'selected' : '' }}>Sin confirmar</option>
                    <option value="confirmado" {{ request('estado') == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                    <option value="denegado" {{ request('estado') == 'denegado' ? 'selected' : '' }}>Denegado</option>
                    <option value="suspendido" {{ request('estado') == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                </select>
           </form>
        </div>
        <div>
            <button class="botonReporte">Generar Reporte</button>
        </div>
    </div>
</div>
<div class="contenidoTabla">
    <div class="tabla" id="tablaSolicitudes">
        <div class="fila">
            <div class="contBotones">
                <button class="nomCol">Estado</button>
            </div>
            <div class="contBotones">
                <button class="nomCol">Fecha</button>
            </div>
            <div class="contBotones">
                <button class="nomCol">Horario</button>
            </div>
            <div class="contBotones" >
                <button class="nomCol">Aula</button>
            </div>
            <div class="contBotones" >
                <button class="nomCol">Motivo</button>
            </div>
            <div class="contBotones" >
                <button class="nomCol">Acciones</button>
            </div>
        
        </div>
        <div id="tbody">
            @foreach($solicitudes as $solicitud)
            <div class="fila" data-id="{{ $solicitud->id }}" data-estado="{{ $solicitud->estado }}">
                <!-- Contenido de la fila -->
                <p>{{ $solicitud->estado }}</p>
                <p>{{ $solicitud->fecha }}</p>
                <p>{{ $solicitud->horario }}</p>
                <p>{{ $solicitud->nro_aula }}</p>
                <p>{{ $solicitud->motivo }}</p>
                <div class="botones-container" id="botcontenedor">
                    @if($solicitud->estado == 'Sin confirmar')
                        <div>
                                        <form action="{{ route('solicitud.habilitar', $solicitud->idsolicitud) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button title="Confirmar solicitud" onclick="botonCancelar2()" ><i class="fa-solid fa-circle-check"></i></button>
                                        </form>
                        </div>
                        <div>
                            <button title="Rechazar Solicitud" onclick="botonCancelar()" ><i class="fa-solid fa-circle-xmark" ></i></button>
                            <div id="modal-confirmacion" class="modal">
                                <div class="modal-contenido">
                                    <p>¿Está seguro de que desea denegar la solicitud de reserva?</p>
                                    <div class="botonesCentro">
                                        <button id="boton-confirmar"  class="botones" type="button" onclick="botonSalirClick()" >Salir</button>
                                        <form action="{{ route('solicitud.denegar', $solicitud->idsolicitud) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button id="boton-salir"  class="botones" type="submit">Confirmar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->usuario }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                            
                        </div>
                    @elseif($solicitud->estado == 'confirmado')   
                        <div>
                            <button title="Rechazar Solicitud" onclick="botonCancelar()" ><i class="fa-solid fa-circle-xmark" ></i></button>
                            <div id="modal-confirmacion" class="modal">
                        
                                <div class="modal-contenido">
                                    <p>¿Está seguro de que desea denegar la solicitud de reserva?</p>
                                    <div class="botonesCentro">
                                        <button id="boton-confirmar"  class="botones" type="button" onclick="botonSalirClick()" >Salir</button>
                                        <form action="{{ route('solicitud.denegar', $solicitud->idsolicitud) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button id="boton-salir"  class="botones" type="submit">Confirmar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->usuario }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                           
                        </div>
                    @elseif($solicitud->estado == 'denegado')
                        <div>
                            <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->usuario }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                            
                        </div>  
                    @elseif($solicitud->estado == 'suspendido')
                        <div>
                            <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->usuario }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                            
                        </div>
                    @endif
                </div>
                
            </div>
            <div id="modal-mensaje" class="modal">
                <div class="modal-contenido">
                    <p class="subtitulo">Información del solicitante</p>
                    <div class="datos">
                        <p id="nombre"></p>
                        <p id="materia"></p>
                        <p id="aula"></p>
                        <p id="horario"></p>
                    </div>
                    <button class="botones" onclick="cerrarModalMensaje()">Cerrar</button>
                </div>
            </div>

            @endforeach
            
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    function filtrarSolicitudes() {
        document.getElementById('solicitudEstado').submit();
        
    }
    function botonInfo() {
        var modal = document.getElementById("modal-confirmacion2");
        modal.style.display = "block";
    }

    function botonCancelar() {
        var modal = document.getElementById("modal-confirmacion");
        modal.style.display = "block";
    }
    // Obtener el botón de salir del modal
    var botonSalir = document.getElementById("boton-salir");
    // Obtener el botón de confirmar del modal
    var botonConfirmar = document.getElementById("boton-confirmar");
    // Cuando se hace clic en el botón de salir, ocultar el modal
    function botonSalirClick() {
        var modal = document.getElementById("modal-confirmacion");
        modal.style.display = "none";
    }
    // Cuando se hace clic en el botón de confirmar, ocultar el modal
    function botonConfirmarClick() {
        var modal = document.getElementById("modal-confirmacion");
        modal.style.display = "none";
    }
    
  


    function mostrarModalMensaje(nombre, materia, aula, horario) {
        // Llenar el modal con los datos recibidos
        document.getElementById('nombre').innerText = 'Nombre: ' + nombre;
        document.getElementById('materia').innerText = 'Materia: ' + materia;
        document.getElementById('aula').innerText = 'Aula: ' + aula;
        document.getElementById('horario').innerText = 'Horario: ' + horario;

        // Mostrar el modal
        var modal = document.getElementById('modal-mensaje');
        modal.style.display = 'block';
    }

    function cerrarModalMensaje() {
        var modal = document.getElementById('modal-mensaje');
        modal.style.display = 'none';
    }

</script>

@endsection






