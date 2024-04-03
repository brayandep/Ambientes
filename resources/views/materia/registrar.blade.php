@extends('layoutes.plantilla')

@section('titulo', 'Registrar Materia')

@section('links')
    <link rel="stylesheet" href="{{asset('css/styleMateria.css')}}">
@endsection

@section('estilos')
    {{-- Aqui vendran estilos --}}
@endsection

@section('contenido')
    <main>
        <div>
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
                        <option value="Departamento1">Departamento1</option> 
                        <option value="Departamento2">Departamento2</option> 
                        <option value="Departamento3">Departamento3</option>
                        <option value="Departamento4">Departamento4</option> 
                        <option value="Departamento5">Departamento5</option>  
                    </select>

                    @error('departamento')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label class="labMateria">Carrera</label>
                    <select class="inputMateria" id="carrera" name="carrera">
                        <option value="">Seleccione la carrera</option> 
                        <?php 
                            $antiguo = old('carrera');
                            if($antiguo){echo"<option value='$antiguo' selected>$antiguo</option>";}
                        ?>
                        <option value="Ing. de Sistemas">Ing. de Sistemas</option> 
                        <option value="Ing. Informatica">Ing. Informatica</option> 
                        <option value="Ing. Industrial">Ing. Industrial</option> 
                        <option value="Ing. Quimica">Ing. Quimica</option>  
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

                <div class="input-group">
                    <label class="labMateria">Nivel</label>
                    <select class="inputMateria" id="nivel" name="nivel">
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

                    <label class="labMateria">Cantidad de Grupos</label>
                    <select class="inputMateria" id="grupo" name="cantGrupo">
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
                
                <div class="botones">
                    <button onclick="enviarFormulario()" type="button" class="btnCancelar">Cancelar</button>
                    <button onclick="enviarFormulario()" type="submit" class="btnRegistrar">Registrar</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{asset('js/scriptMateria.js')}}"></script>
@endsection
