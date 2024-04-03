@extends('layoutes.plantilla')

@section('titulo', 'Editar Materia')

@section('links')
    <link rel="stylesheet" href="{{asset('css/styleMateria.css')}}">
@endsection

@section('estilos')
    {{-- Aqui vendran estilos --}}
@endsection

@section('contenido')
    <main>
        <div>
            <h1><i class='fas fa-edit'></i> Editar Materia</h1>
            <form action="{{route('materia.update', $materia)}}" method="POST" class="materia" enctype="multipart/form-data" id="materia">
                @csrf
                @method('put')

                <div class="input-group">
                    <label class="labMateria">Departamento</label>
                    <select required class="inputMateria" id="departamento" name="departamento" value = "{{$materia->departamento}}">
                        <option value="">Seleccione el departamento</option> 
                        <option value="{{$materia->departamento}}" selected>{{$materia->departamento}}</option>
                        <option value="Departamento1">Departamento1</option> 
                        <option value="Departamento2">Departamento2</option> 
                        <option value="Departamento3">Departamento3</option> 
                    </select>
                    @error('departamento')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label class="labMateria">Carrera</label>
                    <select required class="inputMateria" id="carrera" name="carrera">
                        <option value="">Seleccione la carrera</option>
                        <option value="{{$materia->carrera}}" selected>{{$materia->carrera}}</option>
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
                    <input required name="nombre" class="inputMateria" id="nomPl" placeholder="Max. 100 caracteres" value = "{{$materia->nombre}}">
                    @error('nombre')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label class="labMateria" id="labMateria">Codigo</label>
                    <input required name="codigo" autocomplete="off" class="inputMateria" id="nomPl" placeholder="Max. 100 caracteres" value = "{{$materia->codigo}}">
                    @error('codigo')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label class="labMateria">Nivel</label>
                    <select required class="inputMateria" id="nivel" name="nivel" value = "{{$materia->nivel}}">
                        <option value="">Seleccione el nivel</option> 
                        <option value="{{$materia->nivel}}" selected>{{$materia->nivel}}</option>
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
                    <select required class="inputMateria" id="grupo" name="cantGrupo" value = "{{$materia->cantGrupo}}">
                        <option value="">Seleccione la cantidad de grupos</option> 
                        <option value="{{$materia->cantGrupo}}" selected>{{$materia->cantGrupo}}</option>
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
                    <button onclick="enviarFormulario()" type="submit" class="btnRegistrar">Actualizar Materia</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{asset('js/scriptMateria.js')}}"></script>
@endsection
