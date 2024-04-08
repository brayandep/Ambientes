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

            <!-- Contenedor centrado y responsivo -->
            <div class="tabla-responsive">
                <table class="tabla-ver">
                    <thead>
                        <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Capacidad</th>
                            <th scope="col">Ubicación</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Habilitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ambientes as $ambiente)
                            <tr>
                                <td>{{$ambiente->codigo}}</td>
                                <td>{{$ambiente->unidad}}</td>
                                <td>{{$ambiente->nombre}}</td>
                                <td>{{$ambiente->capacidad}}</td>
                                <td>{{$ambiente->ubicacion}}</td>
                                <td>{{$ambiente->descripcion_ubicacion}}</td>
                                <td>
                                    <div class="EditHab">
                                        <button class="accion" onclick="location.href='{{ route('registro.edit', $ambiente) }}';"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('cambiar.estado', $ambiente->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="boton">
                                            <input type="checkbox" id="btn-switch-{{ $ambiente->id }}" name="estado" {{ $ambiente->estadoAmbiente == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label for="btn-switch-{{ $ambiente->id }}" class="lbl-switch"></label>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
