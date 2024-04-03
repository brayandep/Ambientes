@extends('layoutes.plantilla')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleVerMaterias.css') }}">
@endsection

@section('titulo', 'Lista de Materias')

@section('contenido')
    <div class="Navegacion-contenido-ver">
        <div class="Navegacion-ver">
            Inicio > Gestionar Materia > Ver Materia
        </div>
    </div>
    <div class="ver-contenido">
        <div class="visualizar-Materia">
            <div>
                <h1 class="Titulo"><i class="fa-solid fa-rectangle-list"></i> Ver Materias Registradas </h1>
            </div>

            <!-- Tabla de Materias -->
            <div class="tabla">
                <div class="fila">
                    <button class="nomCol">Departamento</button>
                    <button class="nomCol">Carrera</button>
                    <button class="nomCol">Nombre</button>
                    <button class="nomCol">Codigo</button>
                    <button class="nomCol">Nivel</button>
                    <button class="nomCol">Cantidad de Grupos</button>
                    <button class="nomCol">Editar</button>
                </div>
                <div>
                    @foreach ($materias as $Materia)
                        <div class="fila">
                            <p>{{$Materia->departamento}}</p>
                            <p>{{$Materia->carrera}}</p>
                            <p>{{$Materia->nombre}}</p>
                            <p>{{$Materia->codigo}}</p>
                            <p>{{$Materia->nivel}}</p>
                            <p>{{$Materia->cantGrupo}}</p>
                            <div class="EditHab">
                                <button class="accion" onclick="location.href='{{ route('materia.editar', $Materia) }}';"><i class="fa-solid fa-pen-to-square"></i></button>
                            
                            </div>
                            {{-- <form action="{{ route('cambiar.estado', $Materia->id) }}" method="POST">
                                @csrf
                                @method('GET')
                                <div class="boton">
                                    <input type="checkbox" id="btn-switch-{{ $Materia->id }}" name="estado" {{ $Materia->estadoMateria == 1 ? 'checked' : '' }}>
                                    <label for="btn-switch-{{ $Materia->id }}" class="lbl-switch"></label>
                                </div>
                            </form> --}}
                            
                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
