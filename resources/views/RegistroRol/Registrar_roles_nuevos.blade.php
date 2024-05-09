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
        <div class="contForm">
            <div>
                <label >Estado</label>
                <select> 
                    <option value="true">Habilitado</option>
                    <option value="false">Deshabilitado</option>
                </select>
            </div>
            <div >
                <label >Nombre</label>
                <input placeholder="Ingrese el nombre del rol">
            </div>
            <div >
                <label>Descripcion</label>
                <input placeholder="Ingrese una breve descripcion">
            </div>
            <div>
                <label>Vigencia del rol</label>
                <select id="vigencia" name="vigencia" onchange="mostrarFechas(this.value)"> 
                    <option value="1">Permanente</option>
                    <option value="2" >Temporal</option>
                </select>
            </div>
            <div id="rangoFechas">
                <label>Fecha de inicio:</label>
                <input type="date" id="fechaInicio" name="fechaInicio">
                <label>Fecha de fin:</label>
                <input type="date" id="fechaFin" name="fechaFin">
            </div>
            <div >
                <label>Permisos</label>
                <div class="perm">
                    hola
                    mundo
                    como estan
                </div>
            </div>
            <div>
                <button>Cancelar</button>
                <button>Registrar</button>
            </div>
        </div>
    </div>
 </div>
@endsection
@section('scripts')
<script src="{{ asset('js/scriptRol.js') }}"></script>
@endsection