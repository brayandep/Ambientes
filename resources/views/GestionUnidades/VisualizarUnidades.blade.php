@extends('layoutes.plantilla')
@section('links')
    <link rel="stylesheet" href="../../css/styleUnidades.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/styleUnidades.css') }}"> --}}
@endsection
@section('titulo', 'Visualizar unidades')
  
@section('contenido')
        <div class="Navegacion-contenido">
            <div class="Navegacion">
                Inicio > Gestion de unidades > Visualizar unidad
            </div>
        </div>
        <div class="registro-contenido">
            <div class="visualizar">
                <div>
                    <h1 class="Titulo"><i class="fas fa-building"></i> Visualizar Unidad</h1>
                </div>
                <!-- Botón para descargar el PDF -->
                <form class="btnReporte" action="{{ route('descargar.unidades.pdf') }}" method="GET" target="_blank">
                    @csrf
                    <button style="width:150px;" class="nomCol" type="submit" class="btn btn-primary">Generar Reporte</button>
                </form>
                <div class="pizarra">
                    <div class="fila">
                        <div class="columnaT">
                           <button class="nomCol" id="noActivar">Id Unidad</button>
                        </div>
                        <div class="columnaT">
                            <button class="nomCol" id="noActivar">Nombre</button>
                        </div>
                        <div class="columnaT">
                            <button class="nomCol" id="noActivar">Responsable</button>
                        </div>
                        <div class="columnaT">
                            <button class="nomCol" id="noActivar">Nivel</button>
                        </div>
                        <div class="columnaT">
                            <button class="nomCol" id="noActivar">Dependencia</button>
                        </div>
                        @can('Editar unidad')
                            <div class="columnaT">
                                <button class="nomCol" id="noActivar">Acciones</button>
                            </div>
                            <div class="columnaT">
                                <button class="nomCol" id="noActivar">Habilitado</button>
                            </div>
                        @endcan
                    </div>
                    <div>
                        @foreach ($unidades as $unidad)
                            <div class="fila">
                                <p class="columnaT">{{$unidad->id}}</p>
                                <p class="columnaT">{{$unidad->nombreUnidad}}</p>
                                <p class="columnaT">{{$unidad->Responsable}}</p>
                                    @if ($unidad->Nivel == 1)
                                        <p class="columnaT">Facultad</p>
                                        @elseif ($unidad->Nivel == 2)
                                        <p class="columnaT">Decanato</p>
                                        @elseif ($unidad->Nivel == 3)
                                        <p class="columnaT">Departamento</p>
                                        @elseif ($unidad->Nivel == 4)
                                        <p class="columnaT">Laboratorio</p>
                                    @endif
                                <p class="columnaT">{{ $unidad->unidadPadre->id ?? 'Sin dependencia' }}</p>
                                    
                                @can('Editar unidad')
                                    <div class="EliEdi">
                                        <button title="Modificar Unidad" class="accion" onclick="location.href='{{ route('unidad.edit', $unidad) }}';"
                                        {{ $unidad->UnidadHabilitada == 0 ? 'disabled' : '' }}><i class="fa-solid fa-pen-to-square"></i></button>
                                        <!--<button onclick="EliminarUnidad({{ $unidad->id }})" class="accion"><i class="fa-solid fa-trash"></i></button>-->
                                    </div>
                                    <div class="EliEdi">
                                        <form action="{{ route('unidad.habilitar', $unidad->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="form_submitted" value="1">
                                            <div class="boton">
                                                <input type="checkbox" id="btn-switch-{{ $unidad->id }}" name="UnidadHabilitada" {{ $unidad->UnidadHabilitada == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label for="btn-switch-{{ $unidad->id }}" class="lbl-switch"></label>
                                            </div>
                                        </form>
                                    </div>
                                @endcan
                                
                                
                               <!--onchange="EliminarUnidad({{ $unidad->id }}, this)"-->
                                <div class="mensaje_emergente" id="PanelEliminarUnidad-{{ $unidad->id }}">
                                    <div class="info">
                                        ¿Esta seguro que desea deshabilitar la unidad {{$unidad->nombreUnidad}}? 
                                    </div>
                                    <div class="div3Botones">
                                        <button class= "registrar" onclick="VolverVisualizarCheck({{$unidad->id}})" >No</button>
                                        <form action="{{route('unidad.updateEstado', $unidad)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="Deshabilitado" value="2">
                                            <button type="submit" class="cancelar">Si</button>
                                        </form>
                                       <!-- <form action="{{route('unidad.destroy', $unidad)}}" method="POST">
                                            @csrf
                                            @method('delete')   
                                        <button type="submit" class="cancelar"> Si</button>
                                        </form>-->
                                    </div>
                                </div>

                                <!--<div class="mensaje_emergente" id="PanelEliminarUnidadconDepen-{{ $unidad->id }}">
                                    <div class="info">
                                        La unidad no se puede eliminar:
                                        <br>
                                        Esta unidad de {{$unidad->nombreUnidad}} esta relacionado con ambientes en uso actualmente
                                    </div>
                                    <div class="div3Botones">
                                        <button class= "registrar" onclick="VolverVisualizar()" >cerrar</button>
                                        </form>
                                    </div>
                                </div>-->
                            </div>
                            <div id="fondoGris"></div>
                            
                        @endforeach
                    </div>
                </div>
            </div>


            


        </div>
@endsection
@section('scripts')
    {{-- <script src="{{ asset('js/scriptUnidades.js') }}"></script> --}}
    <script src="../../js/scriptUnidades.js"></script>
@endsection
