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
            <th>Fecha</th>
            <th>Horario</th>
            <th>Aula</th>
            <th>Motivo</th>
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
                        <button title="Mas informacion" type="submit" onclick="mostrarInformacion(button)"><i class="fa-solid fa-circle-info"></i></button>
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
                        <button title="Mas informacion" type="submit" onclick="mostrarInformacion(button)"><i class="fa-solid fa-circle-info"></i></button>
                         </div> 

                    @elseif($solicitud->estado == 'denegado')
                    <div>
                        <button title="Mas informacion" type="submit" onclick="mostrarInformacion(button)"><i class="fa-solid fa-circle-info"></i></button>
                         </div> 
                    @elseif($solicitud->estado == 'suspendido')
                          <div>
                        <button title="Mas informacion" type="submit" onclick="mostrarInformacion(button)"><i class="fa-solid fa-circle-info"></i></button>
                         </div> 
                    @endif
                        
                </div>
            </td>
        </tr>
        <div id="modal-confirmacion2" class="modal">
            <div class="modal-contenido">
                <p>Nombre: <span class="Nombre-solicitud"></span></p>
                <p>Materia: <span class="Materia-solicitud"></span></p>
                <p>Aula: <span class="Aula-solicitud"></span></p>
                <p>Horario: <span class="Horario-solicitud"></span></p>
              
                <div class="botonesCentro">
                    <button id="boton-salir" class="botones" type="button" onclick="botonSalirClick()">Salir</button>
                </div>
            </div>
        </div>

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
    
</script>



    
@endsection






