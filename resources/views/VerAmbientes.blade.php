@extends('layoutes.plantilla')

@section('links')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/styleVerAmbientes.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="../../css/styleVerAmbientes.css">
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
                <h1 class="Titulo-ver"><i class="fa-solid fa-rectangle-list"></i> Ver Ambientes Registrados </h1>
            </div>
         

            <!-- Botón para descargar el PDF -->
                <form class="btnReporte" action="{{ route('descargar.ambientes.pdf') }}" method="GET" target="_blank">
                    @csrf
                    <button style="width:150px;" class="nomCol-v" type="submit" class="btn btn-primary">Generar Reporte</button>
                </form>
            <!-- tabla -->
            <div class="tabla-ver">
                <div class="fila-v">
                    <div class="contBotones-v">
                        <button class="nomCol-v" id="noActivar">Unidad</button>
                    </div>
                    <div class="contBotones-v">
                        <button class="nomCol-v" id="noActivar">Nombre </button>
                    </div>
                    <div class="contBotones-v" id="columnaPeque">
                        <button class="nomCol-v" id="noActivar">Capacidad</button>
                    </div>
                    <div class="contBotones-v" id="ubi">
                        <button class="nomCol-v" id="noActivar">Ubicación</button>
                    </div>
                    <div class="contBotones-v">
                        <button class="nomCol-v" id="noActivar">Descripción</button>
                    </div>
                    <div class="contBotones-v" id="columnaPeque">
                        <button class="nomCol-v" id="noActivar">Horario</button>
                    </div>
                    @can('Editar ambiente')
                        <div class="contBotones-v" id="columnaPeque">
                            <button class="nomCol-v" id="noActivar">Editar</button>
                        </div>
                        <div class="contBotones-v" id="columnaPeque">
                            <button class="nomCol-v" id="noActivar">Habilitar</button>
                        </div>   
                    @endcan
                </div>
            
                @foreach ($ambientes as $ambiente)
                    <div class="fila-v">
                        <p class="contBotones-v">{{ $ambiente->unidad }}</p>
                        <p class="contBotones-v">{{ $ambiente->nombre }}</p>
                        <p class="contBotones-v" id="columnaPeque">{{ $ambiente->capacidad }}</p>
                        <p class="contBotones-v" id="ubi"><span>{{ $ambiente->ubicacion }}</span></p> 
                        <p class="contBotones-v">{{ $ambiente->descripcion_ubicacion}}</p>
                        
                        <div class="EditHab" id="columnaPeque">
                            <button title="Ver calendario de Ambiente" class="accion" onclick="location.href='{{ route('calendario.individual', $ambiente) }}';"
                                {{ $ambiente->estadoAmbiente == 0 ? 'disabled' : '' }}>
                                <i class="fa-solid fa-calendar-days"></i>
                            </button>
                        </div>

                        @can('Editar ambiente')
                            <div class="EditHab" id="columnaPeque">
                                <button title="Modificar Ambiente" class="accion" onclick="location.href='{{ route('ambiente.edit', $ambiente) }}';"
                                {{ $ambiente->estadoAmbiente == 0 ? 'disabled' : '' }}>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </div>

                            <div class="EditHab" id="columnaPeque"> 
                                <form action="{{ route('cambiar.estado', $ambiente->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="boton-sw">
                                        <input type="checkbox" id="btn-switch-{{ $ambiente->id }}" name="estado" {{ $ambiente->estadoAmbiente == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label for="btn-switch-{{ $ambiente->id }}" class="lbl-switch"></label>
                                    </div>
                                </form>
                            </div>
                        @endcan
                    </div>
                @endforeach
            </div> 
        {{$ambientes->links()}}   
        </div>
    </div>

@endsection
