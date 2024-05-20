<link rel="stylesheet" type="text/css" href="../../css/stylesbrayan.css">
<link rel="stylesheet" type="text/css" href="../../css/styleGrupo.css">
<style>
    body {
        background-image: url('{{ asset("images/umss.jpg") }}');
        /* Ajusta otros estilos según sea necesario */
    }
</style>



<body>
    
    @if(session('registro_exitoso'))
        <p>¡Registro exitoso! Por favor, inicia sesión.</p>
    @endif
    <form method="POST" action="{{ route('iniciar-sesion') }}">
        @csrf
        <div class="registro-container">
            <div class="section">
                <br>
                <h2 >Login</h2>
                <div class="inicio">
                    <div class="text2">
                        <label for="nombre" class="texto2">Correo Electronico:</label><br>
                    </div>
                       <br>
                        <div class="form-group">
                        <input class="input3" type="text" id="email" name="email" required autofocus placeholder="Ingresa el correo del usuario">
                        
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="text2">
                        <label for="password" class="texto2">Contraseña:</label><br>
                    </div>
                    <br>
                           <div class="form-group">
                        <input class="input3" type="password" id="password" name="password" required placeholder="Ingrese su contraseña">
                        @error('password')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                  
                </div>
                <div>
                    <input type = "checkbox" class="form-check-input" id="rememberCheck" name="remenber">
                    <label class="form-check-label" for="remenberCheck">
                        Mantener sesión iniciada</label>
                </div>
                <button class="boton4" type="submit">Iniciar</button>
                <br>
                <br>
                <a class="boton5" href="{{ route('inicio') }}">Modo Invitado</a>
                <br>
               
            </div>
        </div>
    </form>
</body>

