@extends('layoutes.plantilla')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleVerMaterias.css') }}">
@endsection

@section('titulo', 'Lista de Materias')

@section('contenido')
    <div class="ver-contenido">
        <div class="visualizar-Materia">
            <div class="navegacion">
                Inicio > Materia > Lista
            </div>
            <div>
                <h1 class="titulo"><i class="fa-solid fa-rectangle-list"></i> Ver Materias Registradas </h1>
            </div>

            <!-- Tabla de Materias -->
            <div class="tabla">
                <div class="fila">
                    <div class="contBotones">
                        <button class="nomCol">Departamento</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol">Carrera</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol">Nombre</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">Codigo</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">Nivel</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">Grupos</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">Editar</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">Grupos</button>
                    </div>
                </div>
                <div>
                    @foreach ($materias as $Materia)
                        <div class="fila">
                            <p>{{$Materia->departamento}}</p>
                            <p>{{$Materia->carrera}}</p>
                            <p>{{$Materia->nombre}}</p>
                            <p id="columnaPeque">{{$Materia->codigo}}</p>
                            <p id="columnaPeque">{{$Materia->nivel}}</p>
                            <p id="columnaPeque">{{$Materia->cantGrupo}}</p>
                            <div class="EditHab" id="columnaPeque">
                                <button class="accion" onclick="location.href='{{ route('materia.editar', $Materia) }}';"><i class="fa-solid fa-pen-to-square"></i></button>
                            </div>

                            <div class="EditHab" id="columnaPeque">
                                <button class="accion" onclick="location.href='{{ route('grupo.create', $Materia) }}';"><i class="fa-solid fa-user-group"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{$materias->links()}}
        </div>
    </div>

@endsection
