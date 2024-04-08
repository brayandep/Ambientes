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
                    <div class="form-fila">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre">
                        
                        <label for="capacidad">Capacidad:</label>
                        <input type="number" id="capacidad" name="capacidad">
                        
                        <label for="dia">Día:</label>
                        <!-- Utilizamos un select (combobox) para los días de la semana -->
                        <select id="dia" name="dia">
                            <option value="lunes">Seleccionar</option>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miercoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sabado">Sábado</option>
                        </select>
                    </div>
                
                    <div class="form-fila">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha">
                        
                        <label for="hora">Hora:</label>
                        <input type="time" id="hora" name="hora">
                        
                        <label for="equipo">Equipo:</label>
                        <input type="text" id="equipo" name="equipo">
                    </div>
                
                    <div class="button-fila">
                        <button class="Buscar">Buscar</button>
                        <button class="Limpiar">Limpiar Búsqueda</button>
                    </div>
                </form>
            </div>
            <div>
                <h2 class="Resultado-search"> Resultado de la búsqueda </h2>
            </div>
            <div class="pizarra-search">
                <div class="fila">
                    <button class="nomCol">Nombre</button>
                    <button class="nomCol">Capacidad</button>
                    <button class="nomCol">Dia</button>
                    <button class="nomCol">Fecha</button>
                    <button class="nomCol">Hora</button>
                    <button class="nomCol">Equipos disponibles</button>
                    <button class="nomCol">Reservar</button>
                </div>
            </div>
        </div>
    </div>
@endsection