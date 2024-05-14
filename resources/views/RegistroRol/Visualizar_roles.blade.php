@extends('layoutes.plantilla')

@section('links')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/styleVerMaterias.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="../../css/styleVerMaterias.css">
    <link rel="stylesheet" type="text/css" href="../../css/verRoles.css">
@endsection

@section('titulo', 'Lista de Materias')

@section('contenido')
    <div class="ver-contenido">
        <div class="visualizar-Materia">
            <div class="navegacion">
                Inicio > Roles > Lista
            </div>
            <div>
                <h1 class="titulo"><i class="fa-solid fa-rectangle-list"></i> Lista de roles </h1>
            </div>
            <!-- Botón para descargar el PDF -->
                <form class="btnReporte" action="" method="GET" target="_blank">
                    @csrf
                    <button style="width:150px;" class="nomCol" type="submit" class="btn btn-primary">Generar Reporte</button>
                </form>

            <!-- Tabla de Materias -->
            <div class="tabla">
                <div class="fila">
                    <div class="contBotones">
                        <button class="nomCol">ID</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol">Nombre</button>
                    </div>
                    <div class="contBotones">
                        <button class="nomCol">Vigencia</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">Acciones</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol">Habilitado</button>
                    </div>
                </div>
                <div>
                    @foreach ($roles as $rol)
                        <div class="fila">
                            <p>{{$rol->id}}</p>
                            <p>{{$rol->name}}</p>
                            <p>{{$rol->tipoVigencia}}</p>
                            <div class="EditHab" id="columnaPeque">
                                <button class="accion" onclick="mostrarInfoRol('{{ $rol->id }}')"><i class="fa-solid fa-circle-info"></i></button>
                            </div>

                            <div class="EditHab" id="columnaPeque">
                                <form action="{{ route('Rol.habilitar', $rol->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="boton-sw">
                                        <input type="checkbox" id="btn-switch-{{ $rol->id }}" name="Estado" {{ $rol->Estado == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label for="btn-switch-{{ $rol->id }}" class="lbl-switch"></label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="panel" id="panelVerRol-{{ $rol->id }}">
                            <div class="info">
                                <p>Informacion:</p>
                                <p>Descripcion: {{$rol->descripcionRol}}</p>
                                @if (!empty($rol->fechaFinRol))
                                <p>Vigente desde: {{$rol->fechaInicioRol}} hasta {{$rol->fechaFinRol}}</p>
                                @else
                                <p>Vigencia: Permanente</p>
                                @endif
                                <p>los permisos son:</p>
                                
                                <div id="permissionsList"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{$roles->links()}}
        </div>
    </div>

@endsection
@section('scripts')
<script src="{{ asset('js/scriptRol.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection