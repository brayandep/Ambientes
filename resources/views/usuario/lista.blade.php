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
                Inicio > Usuarios > Lista
            </div>
            <div>
                <h1 class="titulo"><i class="fa-solid fa-rectangle-list"></i> Lista de Usuarios </h1>
            </div>
            <!-- Botón para descargar el PDF -->
                <form class="btnReporte" action="" method="GET" target="_blank">
                    @csrf
                    <button style="width:150px;" class="nomCol" type="submit" class="btn btn-primary">Generar Reporte</button>
                </form>

            <!-- Tabla de Materias -->
            <div class="tabla">
                <div class="fila">
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">ID</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol">Nombre</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol">Correo</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol">Contraseña</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">Roles</button>
                    </div>
                </div>
                <div>
                    @foreach ($usuarios as $usuario)
                        <div class="fila">
                            <p id="columnaPeque">{{$usuario->id}}</p>
                            <p>{{$usuario->nombre}}</p>
                            <p>{{$usuario->email}}</p>
                            <p>{{$usuario->password}}</p>
                            <div class="EditHab" id="columnaPeque">
                                <button class="accion" onclick="location.href='{{ route('Usuario.edit', $usuario) }}';"><i class="fa-solid fa-edit"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{$usuarios->links()}}
        </div>
    </div>
    <div id="fondoGris"></div>

@endsection
@section('scripts')
<script src=""></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection