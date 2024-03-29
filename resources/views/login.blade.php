<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="nombre">Nombre de usuario:</label><br>
            <input type="text" id="nombre" name="nombre" required autofocus>
        </div>
        <div>
            <label for="contraseña">Contraseña:</label><br>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>