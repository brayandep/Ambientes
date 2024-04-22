<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Archivo</title>
</head>
<body>
    <h1>{{ $publicacion->titulo }}</h1>
    
    <<iframe src="{{ asset('storage/' . $rutaArchivo) }}" style="width: 100%; height: 500px;"></iframe>
    <br>
    <a href="{{ asset('storage/' . $rutaArchivo) }}" target="_blank" download>Descargar Archivo</a>

    <br>
    <button onclick="window.print()">Imprimir Archivo</button>
</body>
</html>
