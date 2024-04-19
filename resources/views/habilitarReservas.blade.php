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
           
            <select class="input2" id="estado" name="estado" onchange="filtrarSolicitudes()">
                <option value="">Estado de solicitud</option>
                <option value="Sin confirmar">Sin confirmar</option>
                <option value="confirmado">Confirmado</option>
                <option value="denegado">Denegado</option>
                <option value="suspendido">Suspendido</option>
            </select>
        </div>
        <div>
            <button class="botonReporte">Generar Reporte</button>
        </div>
    </div>
</div>

<table  id="tablaSolicitudes" class="centro" border="1">
    <thead>
        <tr class="colorcolumna">
            <th>Estado</th>
            <th><a href="#" onclick="ordenarPorFecha()">Fecha</a></th>
            <th>Horario</th>
            <th>Aula</th>
            <th><a href="#" onclick="ordenarPorMotivo()">Motivo</a></th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitudes as $solicitud)
        <tr class="contentcolumna" data-id="{{ $solicitud->id }}" data-estado="{{ $solicitud->estado }}">
            <!-- Contenido de la fila -->
            <td>{{ $solicitud->estado }}</td>
            <td>{{ $solicitud->fecha }}</td>
            <td>{{ $solicitud->horario }}</td>
            <td>{{ $solicitud->nro_aula }}</td>
            <td>{{ $solicitud->motivo }}</td>
            
            <td>
                <div class="botones-container">
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
                        </div>

                    @elseif($solicitud->estado == 'denegado')
                        <div>
                            <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->usuario }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
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
                        </div>

                         
                    @elseif($solicitud->estado == 'suspendido')
                    <div>
                        <button title="Mas informacion" type="submit" onclick="mostrarModalMensaje('{{ $solicitud->usuario }}', '{{ $solicitud->materia }}', '{{ $solicitud->nro_aula }}', '{{ $solicitud->horario }}')">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
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
                    </div>
                    @endif
                        
                </div>
            </td>
        </tr>
       

        @endforeach

    </tbody>
</table>

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

    function ordenarPorFecha() {
        const table = document.getElementById("tablaSolicitudes");
        const rows = Array.from(table.rows).slice(1);

        rows.sort((a, b) => {
            const dateA = new Date(a.cells[1].textContent);
            const dateB = new Date(b.cells[1].textContent);
            return dateA - dateB;
        });

        rows.forEach(row => table.appendChild(row));
    }
    function ordenarPorMotivo() {
        const table = document.getElementById("tablaSolicitudes");
        const rows = Array.from(table.rows).slice(1);

        rows.sort((a, b) => {
            const motivoA = a.cells[4].textContent.trim().toLowerCase();
            const motivoB = b.cells[4].textContent.trim().toLowerCase();

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






