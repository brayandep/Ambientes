@extends('layoutes.plantilla')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/styleUnidades.css') }}">
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
                <div class="pizarra">
                    <div class="fila">
                        <button class="nomCol">Nombre</button>
                        <button class="nomCol">Codigo</button>
                        <button class="nomCol">Nivel</button>
                        <button class="nomCol">Dependencia</button>
                        <button class="nomCol">Responsable</button>
                        <button class="nomCol">Acciones</button>
                    </div>
                    <div>
                        @foreach ($unidades as $unidad)
                            <div class="fila">
                                <p>{{$unidad->nombreUnidad}}</p>
                                <p>{{$unidad->codigoUnidad}}</p>
                                <p>{{$unidad->Responsable}}</p>
                                <p>{{$unidad->Nivel}}</p>
                                <p>{{$unidad->Dependencia}}</p>
                                <div class="EliEdi">
                                    <button class="accion" onclick="location.href='{{ route('unidad.edit', $unidad) }}';"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button onclick="EliminarUnidad({{ $unidad->id }})" class="accion"><i class="fa-solid fa-trash"></i></button>
                                    
                                </div>
                                <div id="fondoGris"></div>
                                <!-- panel eliminar sin dependencia-->
                                <div class="mensaje_emergente" id="PanelEliminarUnidad-{{ $unidad->id }}">
                                    <div class="info">
                                        La unidad se puede eliminar:
                                        <br>
                                        ¿Esta seguro que desea eliminar la unidad {{$unidad->nombreUnidad}}? 
                                    </div>
                                    <div class="div3Botones">
                                        <button class= "registrar" onclick="VolverVisualizar()" >No</button>
                                        <form action="{{route('unidad.destroy', $unidad)}}" method="POST">
                                            @csrf
                                            @method('delete')   
                                        <button type="submit" class="cancelar"> Si</button>
                                        </form>
                                    </div>
                                </div>
                                <!--panel de eliminar si hay dependencia 
                                <div class="mensaje_emergente" id="PanelEliminarUnidadconDepen-{{ $unidad->id }}">
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
                            
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/scriptUnidades.js') }}"></script>
@endsection
