@extends('layoutes.plantilla')
@section('contenido')
<body>
    <h1>{{ $publicacion->titulo }}</h1>
    <iframe src="{{ $rutaArchivo }}" style="width: 100%; height: 500px;"></iframe>
    <br>
    <a href="{{ $rutaArchivo }}" target="_blank" download>Descargar Archivo</a>
    <br>
    <button onclick="window.print()">Imprimir Archivo</button>
</body>
</html>
@endsection