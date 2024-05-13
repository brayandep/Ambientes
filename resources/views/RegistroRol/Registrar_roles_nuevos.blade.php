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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('Rol.store')}}" method="POST" class="contForm">
            @csrf
            <div class="input-group">
                <label class="labRol" >Estado</label>
                <select class="inputRol" name='Estado'> 
                    <option value="1">Habilitado</option>
                    <option value="0">Deshabilitado</option>
                </select>
            </div>
            <div class="input-group">
                <label class="labRol" >Nombre</label>
                <input class="inputRol" name='name' placeholder="Ingrese el nombre del rol">
            </div>
            <div class="input-group">
                <label class="labRol">Descripcion</label>
                <input class="inputRol" name='descripcionRol' placeholder="Ingrese una breve descripcion">
            </div>
            <div class="input-group">
                <label class="labRol">Vigencia del rol</label>
                <select class="inputRol" id="vigencia" name="tipoVigencia" onchange="mostrarFechas(this.value)"> 
                    <option value="permanente">Permanente</option>
                    <option value="temporal" >Temporal</option>
                </select>
            </div>
            <div class="input-group" id="rangoFechas">
                {{-- <label>Fecha de inicio:</label> --}}
                <input type="date" name='fechaInicioRol' id="fechaInicio">
                <label class="labRol">Fecha de fin:</label>
                <input class="inputRol" name='fechaFinRol' type="date" id="fechaFin">
            </div>
            {{-- name="fechaFin" --}}
            <div class="input-group" >
                <label class="labRol" for="permissions">Permisos:</label>
                <section class="perm">
                    @foreach ($permissions as $permission)
                        <label class="labPerm" for="perm{{ $permission->id }}"><input type="checkbox" id="perm{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                    @endforeach
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