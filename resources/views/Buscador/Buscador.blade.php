@extends('layoutes.plantilla')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleBuscador.css') }}">
@endsection

@section('titulo', 'Buscar')

@section('contenido')
    <div class="Navegacion-search">
        <div class="Navegacion-contenido-search">
            Inicio > Buscar 
        </div>
    </div>

    <div class="search-contenido">

        <div class="visualizar-busqueda"> 
            <div>
                <h1 class="Titulo-search"><i class="fas fa-search"></i> Buscar Ambiente </h1>
            </div>
            <div>
                <form>
                    <div class="form-fila-s">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombreSearch" name="nombreSearch" maxlength="20" autocomplete="off" placeholder="Nombre del ambiente">
                        @error('nombre')
                        <span class="msgError">*{{$message}}</span>
                        @enderror

                        <label for="capacidad">Capacidad:</label>
                        <input type="text" id="capacidadSearch" name="capacidadSearch" maxlength="3" autocomplete="off" placeholder="Capacidad">

                        <label for="dia">Día:</label>
                        <!-- Utilizamos un select (combobox) para los días de la semana -->
                        <select id="dia" name="dia">

                            <option value="todos">Seleccionar</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miercoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sabado">Sábado</option>
                        </select>
                    </div>
                
                    <div class="form-fila-s">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" min="{{ date('Y-m-d') }}">
                        
                        <label for="horaIni">Hora de inicio:</label>
                        <input type="time" id="hora" name="hora">
                        
                        <label for="horaFin">Hora de fin:</label>
                        <input type="time" id="hora" name="hora">
                    </div>
                
                    <div class="button-fila-b">
                        <button class="Buscar">Buscar</button>
                        <button class="Limpiar">Limpiar Búsqueda</button>
                    </div>
                </form>
            </div>

            <div class="titulo-boton">
                <h2 class="Resultado-search"> Resultado de la búsqueda </h2>
                <button class="Buscar-Reservar">Reservar</button>
            </div>
            <div class="tabla-search">
                <div class="fila-b">
                    <div class="contBotones">
                        <button class="nomCol-b">Nombre</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-b">Capacidad</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-b">Dia</button>
                    </div>
                    <!--<div class="contBotones">
                        <button class="nomCol-b">Fecha</button>
                    </div>-->
                    <div class="contBotones">
                        <button class="nomCol-b">Hora de inicio</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol-b">Hora de fin</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-b">Calendario</button>
                    </div>             
                </div>
                
                @foreach ($ambientes as $ambiente)
                    @if ($ambiente->estadoAmbiente == 1)
                        @foreach ($horarios as $horario)
                            @if ($horario->ambiente_id === $ambiente->id )
                                <div class="fila-b">
                                    <div class="seleccionAmb">
                                    <div class="seleccion">
                                        <input type="checkbox" class="checkbox-seleccion">
                                    </div>
                                    <p>{{ $ambiente->nombre }}</p>
                                    </div>
                                    <p id="columnaPeque">{{ $ambiente->capacidad }}</p>
                                    <p id="columnaPeque">{{ $horario->dia }}</p>
                                    <p>{{ $horario->horaInicio }}</p>
                                    <p>{{ $horario->horaFin }}</p>
                                    <div class="Buscar-Calendario" id="columnaPeque">
                                        <button class="buscaCalendario" onclick="location.href='';">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif    
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!--
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            const horaIni = document.getElementById('horaIni').value;
            const horaFin = document.getElementById('horaFin').value;

            if (horaIni >= horaFin) {
                alert('La hora de fin debe ser posterior a la hora de inicio.');
                event.preventDefault(); // Evitar que se envíe el formulario
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const limpiarBtn = document.querySelector('.Limpiar');

        limpiarBtn.addEventListener('click', function() {
            // Obtener todos los elementos de entrada y combobox
            const elementos = document.querySelectorAll('input, select');

            // Recorrer todos los elementos y restablecer sus valores
            elementos.forEach(function(elemento) {
                if (elemento.type === 'text' || elemento.tagName === 'SELECT') {
                    elemento.value = ''; // Limpiar el valor del campo
                } else if (elemento.type === 'date' || elemento.type === 'time') {
                    elemento.value = ''; // Limpiar el valor del campo de fecha/hora
                }
            });
        });
    });
</script>
-->
@endsection