@extends('layoutes.plantilla')

@section('links')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/styleBuscador.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="../../css/styleBuscador.css">
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
                <form action="{{route('buscador')}}" method="GET">
                    <div class="form-fila-s">
                        <div class="input-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" maxlength="25" autocomplete="off" placeholder="Nombre del ambiente. Ejem: 617, 617C" value="{{ old('nombre', request('nombre')) }}">
                            @error('nombre')
                            <span class="msgError">*{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="capacidad">Capacidad:</label>
                            <input type="text" id="capacidad" name="capacidad" maxlength="3" autocomplete="off" placeholder="Capacidad del ambiente. Ejem: 80, 100" value="{{ old('capacidad', request('capacidad')) }}">
                            @error('capacidad')
                                <span class="msgError">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="dia">Día:</label>
                            <!-- Utilizamos un select (combobox) para los días de la semana -->
                            <select class="input-dia" name="dia">
                            <option value="">Seleccionar</option>
                            <option value="1" {{ request('dia') == '1' ? 'selected' : '' }}>Lunes</option>
                            <option value="2" {{ request('dia') == '2' ? 'selected' : '' }}>Martes</option>
                            <option value="3" {{ request('dia') == '3' ? 'selected' : '' }}>Miércoles</option>
                            <option value="4" {{ request('dia') == '4' ? 'selected' : '' }}>Jueves</option>
                            <option value="5" {{ request('dia') == '5' ? 'selected' : '' }}>Viernes</option>
                            <option value="6" {{ request('dia') == '6' ? 'selected' : '' }}>Sábado</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="form-fila-s">
                        <div class="input-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" min="{{ date('Y-m-d') }}" value="{{ old('fecha', request('fecha')) }}">
                            @error('fecha')
                                <span class="msgError">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="horaIni">Hora de inicio:</label>
                            <input type="time" id="horaInicio" name="horaInicio" value="{{ old('horaInicio', request('horaInicio')) }}">
                            @error('horaInicio')
                                <span class="msgError">*{{ $message }}</span>
                            @enderror                        
                        </div>
                        <div class="input-group">
                            <label for="horaFin">Hora de fin:</label>
                            <input type="time" id="horaFin" name="horaFin" value="{{ old('horaFin', request('horaFin')) }}">
                            @error('horaFin')
                                <span class="msgError">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="button-fila-b">
                        <button class="Buscar" type="submit" value="RealizarBusqueda" id="btnBuscar">Buscar</button>
                        <button class="Limpiar" id="btnLimpiar">Limpiar búsqueda</button>
                    </div>
                </form>
            </div>

            <div class="titulo-boton">
                <h2 class="Resultado-search"> Resultado de la búsqueda: </h2>
            </div>
            <div class="tabla-search">
                <div class="fila-b">
                    <div class="contBotones">
                        <button class="nomCol-b" id="noActivar">Nombre</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-b" id="noActivar">Capacidad</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-b" id="noActivar">Dia</button>
                    </div>
                    <!--<div class="contBotones">
                        <button class="nomCol-b">Fecha</button>
                    </div>-->
                    <div class="contBotones">
                        <button class="nomCol-b" id="noActivar">Hora de inicio</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol-b" id="noActivar">Hora de fin</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-b" id="noActivar">Calendario</button>
                    </div>             
                </div>
                <div class="datos">
                @if ($ambientes->isNotEmpty() && $horarios->isNotEmpty())
                @foreach ($ambientes as $ambiente)
                    @if ($ambiente->estadoAmbiente == 1)
                        @foreach ($horarios as $horario)
                            @if ($horario->ambiente_id === $ambiente->id )
                                <div class="fila-b">
                                    <p class="contBotones">{{ $ambiente->nombre }}</p>
                                    <p class="contBotones" id="columnaPeque">{{ $ambiente->capacidad }}</p>
                                    <p class="contBotones" id="columnaPeque">{{ $diaSemana[$horario->dia] }}</p>
                                    <p class="contBotones">{{ $horario->horaInicio }}</p>
                                    <p class="contBotones">{{ $horario->horaFin }}</p>
                                    <div class="Buscar-Calendario" id="columnaPeque">
                                        <button class="buscaCalendario" onclick="location.href='{{ route('calendario.individual', $ambiente) }}';">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif    
                @endforeach
                @else
                <p>No se encontraron resultados.</p>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
@endsection