@extends('layoutes.plantilla')

@section('titulo', 'Registrar Materia')

@section('links')
    {{-- <link rel="stylesheet" href="{{asset('css/styleMateria.css')}}"> --}}
    <link rel="stylesheet" href="../../css/styleMateria.css">
@endsection

@section('estilos')
    {{-- Aqui vendran estilos --}}
@endsection

@section('contenido')
    <main>
        <div class="primerDiv">
            <div class="navegacion">
                Inicio > Materia > Registrar
            </div>
            <h1><i class='fas fa-book'></i> Registrar Materia</h1>
            <form action="{{route('materia.store')}}" method="POST" class="materia" enctype="multipart/form-data" id="materia">
                @csrf

                <div class="input-group">
                    <label class="labMateria">Departamento</label>
                    <select class="inputMateria" id="departamento" name="departamento">
                        <option value="">Seleccione el departamento</option>
                        <?php 
                            $antiguo = old('departamento');
                            if($antiguo){echo"<option value='$antiguo' selected>$antiguo</option>";}
                        ?> 
                        @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->nombreUnidad }}">{{ $departamento->nombreUnidad }}</option>
                        @endforeach  
                    </select>

                    @error('departamento')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label class="labMateria">Carrera</label>
                    <select class="inputMateria" id="carrera" name="carrera" style="max-height: 50px; overflow-y: auto;">
                        <option value="">Seleccione la carrera</option> 
                        <?php 
                            $antiguo = old('carrera');
                            if($antiguo){echo"<option value='$antiguo' selected>$antiguo</option>";}
                        ?>
                        <option value="Licenciatura Didactica Matematica">Licenciatura Didactica Matematica</option>
                        <option value="Licenciatura En Biologia">Licenciatura En Biologia</option>
                        <option value="Licenciatura En Didactica De La Fisica">Licenciatura En Didactica De La Fisica</option>
                        <option value="Licenciatura En Fisica">Licenciatura En Fisica</option>
                        <option value="Licenciatura En Ing. Electromecanica">Licenciatura En Ing. Electromecanica</option>
                        <option value="Licenciatura En Ingenieria Civil (Nuevo)">Licenciatura En Ingenieria Civil (Nuevo)</option>
                        <option value="Licenciatura En Ingenieria De Alimentos">Licenciatura En Ingenieria De Alimentos</option>
                        <option value="Licenciatura En Ingenieria De Sistemas">Licenciatura En Ingenieria De Sistemas</option>
                        <option value="Licenciatura En Ingenieria Electrica">Licenciatura En Ingenieria Electrica</option>
                        <option value="Licenciatura En Ingenieria Electronica">Licenciatura En Ingenieria Electronica</option>
                        <option value="Licenciatura En Ingenieria Industrial">Licenciatura En Ingenieria Industrial</option>
                        <option value="Licenciatura En Ingenieria Informatica">Licenciatura En Ingenieria Informatica</option>
                        <option value="Licenciatura En Ingenieria Matematica">Licenciatura En Ingenieria Matematica</option>
                        <option value="Licenciatura En Ingenieria Mecanica">Licenciatura En Ingenieria Mecanica</option>
                        <option value="Licenciatura En Ingenieria Quimica">Licenciatura En Ingenieria Quimica</option>
                        <option value="Licenciatura En Matematicas">Licenciatura En Matematicas</option>
                        <option value="Programa De Ingenieria En Biotecnologia">Programa De Ingenieria En Biotecnologia</option>
                        <option value="Programa Lic. En Ingenieria En Energia">Programa Lic. En Ingenieria En Energia</option>
                    </select>
                    @error('carrera')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label class="labMateria" id="labMateria">Nombre</label>
                    <input name="nombre" autocomplete="off" class="inputMateria" id="nomPl" placeholder="Ingrese el nombre" value="{{old('nombre')}}">
                    @error('nombre')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label class="labMateria" id="labMateria">Codigo</label>
                    <input name="codigo" autocomplete="off" class="inputMateria" id="nomPl" placeholder="Ingrese el codigo" value="{{old('codigo')}}">
                    @error('codigo')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                </div>

                <div class="input-group" id="nivel-grupo">
                    <div class="nivel-grupo">
                        <label class="labMateria">Nivel</label>
                        <select class="inputMateria" name="nivel">
                            <option value="">Seleccione el nivel</option>
                            <?php 
                                $antiguo = old('nivel');
                                if($antiguo){echo"<option value='$antiguo' selected>$antiguo</option>";}
                            ?>
                            <option value="A">A</option> 
                            <option value="B">B</option> 
                            <option value="C">C</option>
                            <option value="D">D</option> 
                            <option value="E">E</option> 
                            <option value="F">F</option> 
                            <option value="G">G</option> 
                            <option value="H">H</option>
                            <option value="I">I</option> 
                        </select>
                        @error('nivel')
                            <span class="msgError">*{{$message}}</span>
                            <br>
                        @enderror
                    </div>

                    <div class="nivel-grupo">
                        <label class="labMateria">Cantidad de Grupos</label>
                        <select class="inputMateria" name="cantGrupo">
                            <option value="">Seleccione la cantidad de grupos</option>
                            <?php 
                                $antiguo = old('cantGrupo');
                                if($antiguo){echo"<option value='$antiguo' selected>$antiguo</option>";}
                            ?>
                            <option value="1">1</option> 
                            <option value="2">2</option> 
                            <option value="3">3</option> 
                            <option value="4">4</option> 
                            <option value="5">5</option> 
                        </select>
                        @error('cantGrupo')
                                <span class="msgError">*{{$message}}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="botones">
                    <button onclick="CancelarReg()" type="button" class="btnCancelar">Cancelar</button>
                    <button type="submit" class="btnRegistrar">Registrar</button>
                </div>
            </form>
        </div>

        <div id="fondoGris"></div>
        <div class="panel" id="panelCancelar">
            <p>¿Esta seguro que desea cancelar el registro?</p>
            <div class="btnPanel">
                <button class= "no" onclick="noCancela()" >No</button>
                <button class="si" onclick="location.href='{{ route('materia.show') }}';">Si</button>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="../../js/scriptMateria.js"></script>
@endsection
