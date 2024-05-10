<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/styleGrupo.css') }}">
<style>
    body {
        background-image: url('{{ asset("images/umss.jpg") }}');
        /* Ajusta otros estilos según sea necesario */
    }
</style>



<body>
    <h2>Registro de Usuario</h2>
    @if(session('registro_exitoso'))
        <p>¡Registro exitoso! Por favor, inicia sesión.</p>
    @endif
    <form method="POST" action="{{ route('registro.store') }}">
        @csrf
        <div class="registro-container">
            <div class="section">
                <br>
                <h2 >Login</h2>
                <div class="inicio">
                    <div class="text2">
                        <label for="nombre" class="texto2">Nombre de usuario:</label><br>
                    </div>
                       <br>
                        <div class="form-group">
                        <input class="input3" type="text" id="nombre" name="nombre" required autofocus placeholder="Ingresa el nombre de usuario">
                        
                        @error('nombre')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="text2">
                        <label for="password" class="texto2">Contraseña:</label><br>
                    </div>
                    <br>
                           <div class="form-group">
                        <input class="input3" type="password" id="contraseña" name="contraseña" required placeholder="Ingrese su contraseña">
                        @error('password')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                  
                </div>
                <button class="boton4" type="submit">Registrarse</button>
                <br>
                <button class="boton3" >Entrar como Invitado</button>
            </div>
        </div>
    </form>
</body>

