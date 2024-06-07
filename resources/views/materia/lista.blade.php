@extends('layoutes.plantilla')

@section('links')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/styleVerMaterias.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="../../css/styleVerMaterias.css">
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
            <!-- Botón para descargar el PDF -->
                <form class="btnReporte" action="{{ route('descargar.materias.pdf') }}" method="GET" target="_blank">
                    @csrf
                    <button style="width:150px;" class="nomCol" type="submit" class="btn btn-primary">Generar Reporte</button>
                </form>

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
                    @can('Editar materia')
                        <div class="contBotones" id="columnaPeque">
                            <button class="nomCol">Editar</button>
                        </div>                        
                        <div class="contBotones" id="columnaPeque">
                            <button class="nomCol">Grupos</button>
                        </div>
                        <div class="contBotones" id="columnaPeque">
                            <button class="nomCol">Habilitar</button>
                        </div>
                    @endcan
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

                            @can('Editar materia')
                                <div class="EditHab" id="columnaPeque">
                                    <button class="accion" onclick="location.href='{{ route('materia.editar', $Materia) }}';" {{ $Materia->estado == 0 ? 'disabled' : '' }}><i class="fa-solid fa-pen-to-square"></i></button>
                                </div>                      
                                <div class="EditHab" id="columnaPeque">
                                    <button class="accion" onclick="location.href='{{ route('grupo.create', $Materia) }}';" {{ $Materia->estado == 0 ? 'disabled' : '' }}><i class="fa-solid fa-user-group"></i></button>
                                </div>
                                <div class="EditHab" id="columnaPeque"> 
                                    <form class="formSwitch" action="{{ route('materia.estado', $Materia->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="boton-sw">
                                            <input type="checkbox" id="btn-switch-{{ $Materia->id }}" name="estado" {{ $Materia->estado == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label for="btn-switch-{{ $Materia->id }}" class="lbl-switch"></label>
                                        </div>
                                    </form>
                                </div>
                            @endcan

                        </div>
                    @endforeach
                </div>
            </div>
            {{$materias->links()}}
        </div>
    </div>

@endsection
