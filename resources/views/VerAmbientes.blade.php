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
                <h1 class="Titulo-ver"><i class="fa-solid fa-rectangle-list"></i> Ver Ambientes Registrados </h1>
            </div>

            <!-- Contenedor centrado y responsivo -->
            <div class="tabla-ver">
                <div class="fila-v">
                    <div class="contBotones-v" id="columnaPeque">
                        <button class="nomCol-v">Código</button>
                    </div>
                    <div class="contBotones-v">
                        <button class="nomCol-v">Unidad</button>
                    </div>
                    <div class="contBotones-v">
                        <button class="nomCol-v">Nombre </button>
                    </div>
                    <div class="contBotones-v" id="columnaPeque">
                        <button class="nomCol-v">Capacidad</button>
                    </div>
                    <div class="contBotones-v">
                        <button class="nomCol-v">Ubicación</button>
                    </div>
                    <div class="contBotones-v">
                        <button class="nomCol-v">Descripción</button>
                    </div>
                    <div class="contBotones-v" id="columnaPeque">
                        <button class="nomCol-v">Editar</button>
                    </div>
                    <div class="contBotones-v" id="columnaPeque">
                        <button class="nomCol-v">Habilitar</button>
                    </div>   
                </div>
            
                @foreach ($ambientes as $ambiente)
                    <div class="fila-v">
                        <p id="columnaPeque">{{ $ambiente->codigo }}</p>
                        <p>{{ $ambiente->unidad }}</p>
                        <p>{{ $ambiente->nombre }}</p>
                        <p id="columnaPeque">{{ $ambiente->capacidad }}</p>
                        <p>{{ $ambiente->ubicacion }}</p>
                        <p>{{ $ambiente->descripcion_ubicacion}}</p>
                        <div class="EditHab" id="columnaPeque">
                            <button class="accion" onclick="location.href='{{ route('registro.edit', $ambiente) }}';">
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
                    </div>
                @endforeach
            </div>    
        </div>
    </div>

@endsection
