@extends('layoutes.plantilla')
@section('links')
<link rel="stylesheet" href="{{ asset('css/styleRol.css') }}">

@endsection
@section('titulo', 'Registro de rol')
@section('contenido')
 <div class="cuerpo">
    <div class="cuerpo2">
        <div class="navegacion">
            Inicio > Roles > Registrar nuevo rol
            <h2 class="titulo">Registrar rol</h2>
        </div>
        <form action="" method="POST" class="contForm">
            <div class="input-group">
                <label class="labRol" >Estado</label>
                <select class="inputRol"> 
                    <option value="True">Habilitado</option>
                    <option value="False">Deshabilitado</option>
                </select>
            </div>
            <div class="input-group">
                <label class="labRol" >Nombre</label>
                <input class="inputRol" placeholder="Ingrese el nombre del rol">
            </div>
            <div class="input-group">
                <label class="labRol">Descripcion</label>
                <input class="inputRol" placeholder="Ingrese una breve descripcion">
            </div>
            <div class="input-group">
                <label class="labRol">Vigencia del rol</label>
                <select class="inputRol" id="vigencia" name="vigencia" onchange="mostrarFechas(this.value)"> 
                    <option value="permanente">Permanente</option>
                    <option value="temporal" >Temporal</option>
                </select>
            </div>
            <div class="input-group" id="rangoFechas">
                {{-- <label>Fecha de inicio:</label> --}}
                <input type="date" id="fechaInicio" name="fechaInicio">
                <label class="labRol">Fecha de fin:</label>
                <input class="inputRol" type="date" id="fechaFin" name="fechaFin">
            </div>
            <div class="input-group" >
                <label class="labRol">Permisos</label>
                <section class="perm">
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Registrar unidad</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Editar unidad</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Visualizar unidades</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Regsitara ambiente</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Editar ambiente</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Visualizar ambientes</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Registrar materia</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Editar materia</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Visualizar materias</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Aceptar/denegar reservas</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Crear publicacion</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Eliminar publicacion</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Crear eventos</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Editar eventos</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Eliminar eventos</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Registrar usuario</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Control de bitacoras</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">Generar backups</label>
                    <label class="labPerm"><input type="checkbox" class="inputPerm" name="permiso" value="valor" name="" id="">hola</label>
                </section>
            </div>
            <div class="botones">
                <button type="button" class="btnCancelar">Cancelar</button>
                <button type="submit" class="btnRegistrar">Registrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/scriptRol.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection