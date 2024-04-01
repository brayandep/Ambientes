@extends('layoutes.plantilla')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleVerAmbientes.css') }}">
@endsection

@section('titulo', 'Ver Ambiente')

@section('contenido')
    <div class="Navegacion-contenido-ver">
        <div class="Navegacion-ver">
            Inicio > Gestionar Ambiente > Ver Ambiente
        </div>
    </div>
    <div class="ver-contenido">
        <div class="visualizar-ambiente">
            <div>
                <h1 class="Titulo"><i class="fa-solid fa-rectangle-list"></i> Ver Ambientes Registrados </h1>
            </div>

            <!-- Tabla de Ambientes -->
            <div class="tabla">
                <div class="fila">
                    <button class="nomCol">Codigo</button>
                    <button class="nomCol">Unidad</button>
                    <button class="nomCol">Nombre</button>
                    <button class="nomCol">Capacidad</button>
                    <button class="nomCol">Ubicación</button>
                    <button class="nomCol">Descripción</button>
                    <button class="nomCol">Editar</button>
                    <button class="nomCol">Habilitar</button>
                </div>
                <div>
                    @foreach ($ambientes as $ambiente)
                        <div class="fila">
                            <p>{{$ambiente->codigo}}</p>
                            <p>{{$ambiente->unidad}}</p>
                            <p>{{$ambiente->nombre}}</p>
                            <p>{{$ambiente->capacidad}}</p>
                            <p>{{$ambiente->ubicacion}}</p>
                            <p>{{$ambiente->descripcion_ubicacion}}</p>
                            <div class="EditHab">
                                <button class="accion" onclick="location.href='{{ route('registro.edit', $ambiente) }}';"><i class="fa-solid fa-pen-to-square"></i></button>
                            
                            </div>
                            <div class="EditHab">
                                <button class="accion"><i class="fa-solid fa-pen-to-square"></i></button>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection



