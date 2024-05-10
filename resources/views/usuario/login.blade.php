<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <iframe src="sliderBar.blade.php" width="100%" height="100"></iframe>
    <title>Iniciar sesión</title>
</head>
@include('sliderBar')

<body>
    <h1>Iniciar sesión</h1>
   
        @csrf
    
        <div>
            <label for="nombre">Nombre de usuario:</label><br>
            <input id="nombre" type="text" name="nombre" required autofocus>
        </div>
    
        <div>
            <label for="contraseña">Contraseña:</label><br>
            <input id="contraseña" type="password" name="contraseña" required>
        </div>
    
        <div>
            <button type="submit">Iniciar sesión</button>
        </div>
    
  
</body>
</html>