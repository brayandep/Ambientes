@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="../../css/stylesbrayan.css">
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
        <!-- Botón para descargar el PDF -->
            <form class="btnReporte" action="{{ route('descargar.reservas.pdf') }}" method="GET" target="_blank">
                @csrf
                <button style="width:150px;" class="nomCol" type="submit" class="btn btn-primary">Generar Reporte</button>
            </form>
    </div>
</div>
<div class="contenidoTabla">
    <div class="tabla" id="tablaSolicitudes">
        <div class="fila">
            <div class="contBotones">
                <button class="nomCol" id="noActivar">Estado</button>
            </div>
            <div class="contBotones">
                <button class="nomCol" id="activar" onclick="ordenarPorFechaCreacion()">Orden de llegada</button>
            </div>
            <div class="contBotones">
                <button title="Ordenar por fechas"class="nomCol" id="activar"><a href="#" onclick="ordenarPorFecha()">Fecha solicitud</a></button>
            </div>
            <div class="contBotones">
                <button class="nomCol" id="noActivar">Horario</button>
            </div>
            <div class="contBotones" >
                <button class="nomCol" id="noActivar">Aula</button>
            </div>
            <div class="contBotones" >
                <button title="Ordenar por motivo" class="nomCol" id="activar"><a href="#" onclick="ordenarPorMotivo()">Motivo</a></button>
            </div>
            <div class="contBotones" >
                <button class="nomCol" id="noActivar">Acciones</button>
            </div>
        
        </div>
        <div class="solDatos" id="tbody">
            @foreach($solicitudes as $solicitud)
           
                <div class="fila" data-id="{{ $solicitud->id }}" data-estado="{{ $solicitud->estado }}">
                    <!-- Contenido de la fila -->
                    <p>{{ $solicitud->estado }}</p>
                    <p>{{$solicitud ->created_at }}</p>
                    <p>{{ $solicitud->fecha }}</p>
                    <p>{{ $solicitud->horario }}</p>
                    @foreach($ambientes as $ambiente)
                    @if($solicitud->nro_aula == $ambiente->id)
                       <p> {{ $ambiente->nombre }}</p>
                    @endif
                @endforeach
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
                                 <form action="{{ route('solicitud.denegar', $solicitud->idsolicitud) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <button id="boton-salir" title="Denegar solicitud"  onclick="botonCancelar2()" ><i class="fa-solid fa-circle-xmark" ></i></button>
                                            </form>
                                        
                            </div>
                            <div>
                                <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->nombre }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                                
                            </div>
                        @elseif($solicitud->estado == 'confirmado')   
                        <div>
                            <form action="{{ route('solicitud.denegar', $solicitud->idsolicitud) }}" method="POST">
                                           @csrf
                                           @method('put')
                                           <button id="boton-salir" title="Denegar solicitud"  onclick="botonCancelar2()" ><i class="fa-solid fa-circle-xmark" ></i></button>
                                       </form>
                                   
                       </div>
                       <div>
                        <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->nombre }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                        
                    </div>
                        @elseif($solicitud->estado == 'denegado')
                        <div>
                            <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->nombre }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                            
                        </div>
                        @elseif($solicitud->estado == 'suspendido')
                        <div>
                            <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->nombre }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
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
    
        document.getElementById('horario').innerText = 'Horario: ' + horario;

        // Mostrar el modal
        var modal = document.getElementById('modal-mensaje');
        modal.style.display = 'block';
    }

    function cerrarModalMensaje() {
        var modal = document.getElementById('modal-mensaje');
        modal.style.display = 'none';
    }

    let ordenAscendente = true;
    function ordenarPorFechaCreacion() {
        const table = document.getElementById("tablaSolicitudes");
    const rows = Array.from(table.querySelectorAll('.fila')).slice(1); // Selecciona todas las filas dentro de la tabla

    rows.sort((a, b) => {
        const dateA = new Date(a.querySelector('p:nth-child(2)').textContent.replace(/-/g, '/')); // Convertir la fecha a formato válido (reemplazar '-' por '/')
        const dateB = new Date(b.querySelector('p:nth-child(2)').textContent.replace(/-/g, '/'));

        // Orden ascendente o descendente dependiendo del valor de la variable ordenAscendente
        return ordenAscendente ? dateA - dateB : dateB - dateA;
    });

    // Invertir la variable para el próximo ordenamiento
    ordenAscendente = !ordenAscendente;

    rows.forEach(row => table.appendChild(row));
    }



    function ordenarPorFecha() {
    const table = document.getElementById("tablaSolicitudes");
    const rows = Array.from(table.querySelectorAll('.fila')).slice(1); // Selecciona todas las filas dentro de la tabla

    rows.sort((a, b) => {
        const dateA = new Date(a.querySelector('p:nth-child(3)').textContent); // Selecciona el segundo párrafo de la fila (fecha)
        const dateB = new Date(b.querySelector('p:nth-child(3)').textContent); // Selecciona el segundo párrafo de la fila (fecha)
        return dateA - dateB;
    });

    rows.forEach(row => table.appendChild(row));
}
function ordenarPorMotivo() {
    const table = document.getElementById("tablaSolicitudes");
    const rows = Array.from(table.querySelectorAll('.fila')).slice(1); // Selecciona todas las filas dentro de la tabla

    rows.sort((a, b) => {
        const motivoA = a.querySelector('p:nth-child(6)').textContent.trim().toLowerCase(); // Selecciona el quinto párrafo de la fila (motivo)
        const motivoB = b.querySelector('p:nth-child(6)').textContent.trim().toLowerCase(); // Selecciona el quinto párrafo de la fila (motivo)

        if (motivoA === "examen" && motivoB !== "examen") return -1;
        if (motivoB === "examen" && motivoA !== "examen") return 1;

        if (motivoA === "otro" && motivoB !== "otro") return 1;
        if (motivoB === "otro" && motivoA !== "otro") return -1;

        return motivoA.localeCompare(motivoB);
    });

    rows.forEach(row => table.appendChild(row));
}
   
</script>

@endsection






