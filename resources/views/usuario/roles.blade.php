@extends('layoutes.plantilla')
@section('links')
<link rel="stylesheet" href="../../css/styleRol.css">

@endsection
@section('titulo', 'Registro de rol')
@section('contenido')
 <div class="cuerpo">
    <div class="cuerpo2">
        <div class="navegacion">
            Inicio > Usuario > Roles
            <h2 class="titulo">Usuario: {{$usuario->nombre}}</h2>
        </div>

        <form action="{{route('Usuario.update', $usuario)}}" method="POST" class="contForm">
            @csrf
            @method('put')
            
            <div class="input-group" >
                <label class="labRol" for="permissions">Permisos:</label>
                <section class="perm">
                    @foreach ($roles as $rol)
                        <label class="labPerm" for="perm{{ $rol->id }}">
                            <input type="checkbox" id="perm{{ $rol->id }}" name="roles[]" value="{{ $rol->name }}" {{ in_array($rol->id, $userRoles) ? 'checked' : '' }}>
                            {{ $rol->name }}
                        </label>
                    @endforeach
                </section>
            </div>
            <div class="botones">
                <button type="submit" class= "btnRegistrar" >Guardar</button>
            </div>

        </form>
    </div>
</div>
<div id="fondoGris"></div>
        <div class="mensaje_emergente" id="PanelCancelarRegistroR">
            <div class="info">
                ¿Esta seguro que desea cancelar el registro?
            </div>
            <div class="botones">
                <button class= "btnRegistrar" onclick="VolverRegRol()" >No</button>
                <button class="btnCancelar" onclick="location.href='{{ route('Rol.index') }}';">Si</button>
            </div>
        </div>
@endsection
@section('scripts')
<script src=""></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection