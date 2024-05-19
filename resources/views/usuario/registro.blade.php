@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/styleGrupo.css') }}">

@endsection
@section('titulo', 'Formulario de Solicitud')

@section('contenido')

<div class="contenedor1">

    <div class="NavegacionContenido">
        <div class="navegacion">
        Inicio > Gestión de usuario > Formulario de registro de usuario
        <h2 class="titulo">Formulario de registro de usuario</h2>
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
    <form class="container2" method="POST" action="{{ route('validar-registro') }}">
        @csrf
    <div class="izqDer">  
        <div class="izq">

                <div>
                    <label class="texto" for="nro_aula">Nombre Completo:</label><br>
                    <input class="input"  type="text" id="nombre" name="nombre"  autofocus placeholder="Ingresar nombres ">
                  
                </div>
                <br>
               
                <div>
                    <label class="texto" for="nro_aula">Telefono :</label><br>
                    <input class="input"  type="number" id="telefono" name="telefono"  autofocus  placeholder="Ingresar nro de telefono ">
                    
                </div>
                <br>
                <div>
                    <label class="texto" for="nro_aula">Carnet de identidad  :</label><br>
                    <input class="input"  type="number" id="ci" name="ci"  autofocus  placeholder="Ingresar carnet de identidad ">
                   
                </div>
                <br>
                <div>
                    <label class="texto" for="email">Correo electrónico:</label><br>
                    <input class="input" type="email" id="email" name="email" required  placeholder="Ingresar correo electronico ">
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <br>
                <div>
                    <label class="texto" for="nro_aula">Dirección de domicilio </label><br>
                    <input class="input"  type="text" id="direccion" name="direccion"  autofocus  placeholder="Ingresar direccion de domicilio ">
                
                </div>
        </div>

        <div class="der">
            <div>
                <label class="texto" for="nro_aula">Selecciona tipo de rol:</label><br>
                <select class="input" id="rol" name="rol">
                    <option value="">Selecciona una rol</option>
                    @foreach($roles as $rol)
                      <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                    @endforeach
                    </select>
            </div>
            <br>

            <div>
                <label class="texto" for="password">Contraseña:</label><br>
                <input class="input" type="password" id="password" name="password" required placeholder="Ingresar contraseña ">
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <br>
         
            <br>

        </div>
    </div>   
    <div>
        <button  class="boton" type="submit">Registrarse</button>
        <button  class="boton2"> Cancelar </button>
    </div>
      
    </form>



</div>
@endsection