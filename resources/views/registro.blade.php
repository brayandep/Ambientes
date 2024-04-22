<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    @if(session('registro_exitoso'))
        <p>¡Registro exitoso! Por favor, inicia sesión.</p>
    @endif
    <form method="POST" action="{{ route('registro.store') }}">
        @csrf
        <div>
            <label for="nombre">Nombre de usuario:</label><br>
            <input type="text" id="nombre" name="nombre" required autofocus>
            @error('nombre')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password">Contraseña:</label><br>
            <input type="password" id="contraseña" name="contraseña" required>
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
