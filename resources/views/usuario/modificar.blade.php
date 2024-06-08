@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="../../css/stylesbrayan.css">
<link rel="stylesheet" type="text/css" href="../../css/styleGrupo.css">

@endsection
@section('titulo', 'Formulario de Solicitud')

@section('contenido')

<div class="contenedor1">

    <div class="NavegacionContenido">
        <div class="navegacion">
        Inicio > Gestión de usuario > Formulario de actualización de datos  de usuario
        <h2 class="titulo">Formulario de actualización de datos de usuario</h2>
        @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif    
        </div>
    </div>
    <form class="container2" method="POST"  action="{{ route('user.update') }}">
        @csrf
    <div class="izqDer">  
        <div class="izq">

                <div>
                    <label class="texto" for="nro_aula">Nombre Completo:</label><br>
                    <input class="input"  type="text" id="nombre" name="nombre" value="{{ $user->nombre }}" required autofocus placeholder="Ingresar nombres ">
                    @error('nombre')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <br>
               
                <div>
                    <label class="texto" for="nro_aula">Telefono :</label><br>
                    <input class="input"  type="number" id="telefono" name="telefono" value="{{ $user->telefono }}" required autofocus  placeholder="Ingresar nro de telefono ">
                    @error('telefono')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <br>
                <div>
                    <label class="texto" for="nro_aula">Carnet de identidad  :</label><br>
                    <input class="input"  type="number" id="ci" name="ci" value="{{ $user->ci }}" required autofocus  placeholder="Ingresar carnet de identidad ">
                    @error('ci')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <br>
                <div>
                    <label class="texto" for="email">Correo electrónico:</label><br>
                    <input class="input" type="email" id="email" name="email" value="{{ $user->email }}" required  placeholder="Ingresar correo electronico ">
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <br>
                <div>
                    <label class="texto" for="nro_aula">Dirección de domicilio </label><br>
                    <input class="input"  type="text" id="direccion" name="direccion" value="{{ $user->direccion }}" required autofocus  placeholder="Ingresar direccion de domicilio ">
                    @error('direccion')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
        </div>

        <div class="der">
            <div>
                <label class="texto" for="nro_aula">Selecciona tipo de rol:</label><br>
                <input class="input" id="rol" name="rol" value="{{ $user->rol }}" readonly>
                  
                </input>
            </div>
            
            <br>

            <div>
                <label class="texto" for="password">Contraseña:</label><br>
                <input class="input" type="password" id="password" name="password"   placeholder="Ingresar nueva contraseña ">
            
            </div>
            <br>
         
            <br>

        </div>
    </div>   
    <div>
        <button  class="boton" type="submit">Actualizar</button>
    </div>
      
    </form>



</div>
@endsection