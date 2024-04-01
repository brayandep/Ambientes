@extends('layoutes.plantilla')

@section('titulo', 'Materia')

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
            <form class="materia" method="POST" enctype="multipart/form-data" id="materia">
                <div class="input-group">
                    <label class="labMateria">Departamento</label>
                    <select class="inputMateria" id="departamento" name="departamento">
                        <option value="">Seleccione una opcion</option> 
                        <option value="2022">2022</option> 
                        <option value="2021">2021</option> 
                        <option value="2020">2020</option> 
                    </select>
                </div>

                <div class="input-group">
                    <label class="labMateria">Carrera</label>
                    <select class="inputMateria" id="carrera" name="carrera">
                        <option value="">Seleccione una opcion</option> 
                        <option value="2023">Ing. de Sistemas</option> 
                        <option value="2022">Ing. Informatica</option> 
                        <option value="2021">Ing. Industrial</option> 
                        <option value="2020">Ing. Quimica</option> 
                    </select>
                </div>

                <div class="input-group">
                    <label class="labMateria" id="labMateria">Nombre</label>
                    <input required name="nombre" class="inputMateria" id="nomPl" placeholder="Max. 100 caracteres" oninput="verificarContorno(this)">
                </div>
                <div class="input-group">
                    <label class="labMateria" id="labMateria">Codigo</label>
                    <input required name="codigo" autocomplete="off" class="inputMateria" id="nomPl" placeholder="Max. 100 caracteres" oninput="verificarContorno(this)">
                </div>

                <div class="input-group">
                    <label class="labMateria">Nivel</label>
                    <select class="inputMateria" id="nivel" name="nivel">
                        <option value="">Seleccione una opcion</option> 
                        <option value="2022">2022</option> 
                        <option value="2021">2021</option> 
                        <option value="2020">2020</option> 
                    </select>

                    <label class="labMateria">Grupo</label>
                    <select class="inputMateria" id="grupo" name="grupo">
                        <option value="">Seleccione una opcion</option> 
                        <option value="2022">2022</option> 
                        <option value="2021">2021</option> 
                        <option value="2020">2020</option> 
                    </select>
                </div>
                
                <div class="botones">
                    <button onclick="enviarFormulario()" type="button" class="btnCancelar">Cancelar</button>
                    <button onclick="enviarFormulario()" type="button" class="btnRegistrar">Registrar</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{asset('js/scriptMateria.js')}}"></script>
@endsection
