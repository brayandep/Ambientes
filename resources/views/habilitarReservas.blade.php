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
                    <div>
                        <button title="Confirmar solicitud" onclick="confirmarSolicitud(this)" data-solicitud-id="{{ $solicitud->id }}"><i class="fa-solid fa-circle-check"></i></button>

                    </div>

                    <div>
                    <button title="Rechazar Solicitud"><i class="fa-solid fa-circle-xmark" ></i></button>
                    </div>
                    
                    <div>
                        <button title="Mas informacion" type="submit" onclick="mostrarInformacion(button)"><i class="fa-solid fa-circle-info"></i></button>
                    
                </div>
                </div>
            </td>
        </tr>
        <div id="modal-confirmacion" class="modal">
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
<script>
    // Función para mostrar la información de los elementos de la tabla ambientes en el modal
    function mostrarInformacion(button) {
        // Obtener el ID del ambiente desde un atributo data-* de la fila
        var ambienteId = button.closest('tr').getAttribute('data-ambiente-id');

        // Realizar una solicitud AJAX al backend para obtener la información del ambiente
        fetch('/Versolicitudes/' + solicitudId + '/confirmar', {
            .then(response => response.json())
            .then(data => {
                // Actualizar el contenido del modal con la información obtenida del backend
                var modal = document.getElementById("modal-confirmacion");
                modal.querySelector('.nombre-ambiente').textContent = data.nombre;
                modal.querySelector('.materia-ambiente').textContent = data.materia;
                modal.querySelector('.aula-ambiente').textContent = data.aula;
                modal.querySelector('.horario-ambiente').textContent = data.horario;

                // Mostrar el modal
                modal.style.display = "block";
            })
            .catch(error => {
                console.error('Error al obtener información del ambiente:', error);
            });
    }
</script>


<script>
    // Función para confirmar una solicitud
    function confirmarSolicitud(button) {
        // Obtener el ID de la solicitud desde el atributo data-solicitud-id del botón
        var solicitudId = button.getAttribute('data-solicitud-id');

        // Realizar una solicitud AJAX al backend para actualizar el estado de la solicitud
        fetch(`/Versolicitudes/${solicitudId}/confirmar`, {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Si estás utilizando Laravel y necesitas el token CSRF
    },
    body: JSON.stringify({})
})
        .then(response => {
            if (response.ok) {
                // Actualizar el estado de la solicitud en la interfaz de usuario si la solicitud fue exitosa
                var fila = button.closest('tr');
                fila.querySelector('td:first-child').textContent = 'confirmado';
            } else {
                console.error('Error al actualizar el estado de la solicitud');
            }
        })
        .catch(error => {
            console.error('Error al realizar la solicitud AJAX:', error);
        });
    }
</script>


    
@endsection






