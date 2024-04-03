@extends('layoutes.plantilla')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/styleUnidades.css') }}">
@endsection
@section('titulo', 'Registrar unidad')
@section('contenido')
        <div class="Navegacion-contenido">
            <div class="Navegacion">
            Inicio > Gestion de unidades > Registro de unidad
            </div>
        </div>
        <div class="registro-contenido">
            <div class=registro>
                <form action="{{route('unidad.store')}}" method="POST">
                    @csrf
                    <div class="div1Label">
                            <h1 class=Titulo><i class="fas fa-building"></i> Registro de Unidad</h1>
                            <div class="seleccion">
                                <label class="titulo" for="UnidadHabilitada">Habilitado:</label>
                                <select class="imput" id="UnidadHabilitada" name="UnidadHabilitada">
                                    <option value="1">Si</option> 
                                    <option value="2">No</option> 
                                </select>
                            </div>
                            <label class="titulo"for="nombreUnidad">Nombre de la Unidad: </label>
                            <input class="imput" type="text" id="nombreUnidad" name="nombreUnidad" required maxlength="40" autocomplete="off" placeholder="Ingrese nombre de la unidad" value="{{old('nombreUnidad')}}">
                            @error('nombreUnidad')
                                <span>*{{$message}}</span>
                            @enderror
                            
                            <label class="titulo" for="codigoUnidad">Codigo: </label>
                            <input class="imput" type="text" id="codigoUnidad" name="codigoUnidad" placeholder="Ingrese codigo de la unidad" minlength="8" maxlength="8" autocomplete="off" value="{{old('codigoUnidad')}}">
                            @error('codigoUnidad')
                                <span>*{{$message}}</span>
                            @enderror

                            <label class="titulo"for="Responsable">Responsable: </label>
                            <input class="imput" type="text" id="Responsable" name="Responsable" placeholder="Ingrese responsable de la unidad" required maxlength="40" autocomplete="off" value="{{old('Responsable')}}">
                            @error('Responsable')
                                <span>*{{$message}}</span>
                            @enderror
                    </div>
                    <div class="div2Seleccion">
                            <div class="seleccion">
                                <label class="titulo" for="Nivel">Nivel:</label>
                                <select class="imput" id="Nivel" name="Nivel" onchange="cargarDependencias(this.value)">
                                    <!-- Opciones de nivel aqu� 
                                    <option selected>Seleccione un nivel</option>-->
                                    <option value="">seleccione el nivel</option> 
                                    <option value="0">0  Facultad</option>
                                    <option value="1">1  Decanato</option> 
                                    <option value="2">2  Departamento</option> 
                                    <option value="3">3  laboratorio</option> 
                                </select>
                            </div>
            
                        @error('Nivel')
                                <span>*{{$message}}</span>
                        @enderror
                        <div class="seleccion">
                            <label class="titulo" for="Dependencia">Dependencia:</label>
                            <select class="imput" id="Dependencia" name="Dependencia" >
                                <!-- Opciones de dependeia aqu� -->
                                <option value="">Seleccione la dependencia</option>

                            </select>
                        </div>
                        @error('Dependencia')
                                <span>*{{$message}}</span>
                        @enderror
                    </div>
                    <div class="div3Botones">
                        <button type="button" class= "cancelar" onclick="CancelarRegU()">Cancelar</button>
                        <button type="submit" class="registrar"> Registrar</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="fondoGris"></div>
        <div class="mensaje_emergente" id="PanelCancelarRegistroU">
            <div class="info">
                ¿Esta seguro que desea cancelar el registro?
            </div>
            <div class="div3Botones">
                <button class= "registrar" onclick="VolverRegUnidades()" >No</button>
                <button class="cancelar" onclick="location.href='{{ route('visualizar_unidad') }}';">Si</button>
            </div>
        </div>
        <div class="mensaje_emergente" id="PanelRegistroGuardado">
            <div class="info">
                ¡El registro se guardo exitosamente!
            </div>
            <div class="div3Botones">
                <button class="registrar">Cerrar</button>
            </div>
        </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/scriptUnidades.js') }}"></script>
@endsection