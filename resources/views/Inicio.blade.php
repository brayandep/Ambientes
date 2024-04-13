@extends('layoutes.plantilla')
@section('contenido')
   

<style>
  body {
    font-family: Arial, sans-serif;
  }
  .header {
    background-color: lightblue;
    padding: 20px;
    display: flex; /* Utilizamos flexbox */
    align-items: center; /* Centramos verticalmente */
    border-radius: 20px;
  }
  .sidebar {
    background-color: #f0f0f0;
    padding: 20px;
    float: right;
    width: 20%;
    overflow: hidden; /* Para ocultar cualquier texto que se desborde */
    white-space: nowrap; /* Para evitar que el texto se divida en varias líneas */
    border-radius: 20px;
  }
  .truncate {
  text-overflow: ellipsis; /* Añade puntos suspensivos (...) al final del texto */
  overflow: hidden; /* Oculta cualquier texto que se desborde */
  }
  .announcements {
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 20px;
  }
  .announcements ul li  {
  margin-bottom: 15px; /* Ajusta el valor según el espacio deseado entre las líneas */
  }
  .header img {
    width: 600px;
    height: 300px;
    margin-left: 80px;
    border-radius: 20px; 
  }
  .header h1, .header p {
    margin: 10px; /* Eliminamos el margen por defecto de los elementos */
  }
  .header-text {
    display: flex;
    flex-direction: column;

  }
  .reglamento-title {
  color: #FFFFFF; /* Color celeste para el título */
  background-color:#933864; /* Fondo celeste */
  padding: 10px; /* Añadir relleno para dar más prominencia */
  border-radius: 5px; /* Añadir bordes redondeados */
  }

</style>
</head>
<body>

<div class="header">
  <img src="{{asset('images\inicio.png')}}" alt="Logo de la Universidad">
  <div class="header-text">
    <h1>Reserva de Ambientes</h1>
    <p>Facultad de Ciencias y Tecnología</p>
  </div>
</div>

<div class="sidebar">
  <div class="announcements">

  <h2 class="reglamento-title">Reglamento</h2>
  <ul>
    @foreach($publicaciones as $publicacion)
    
        @if($publicacion->tipo == 'Reglamento')
        
        <li title="{{ $publicacion->titulo }}" class="truncate">{{ $publicacion->titulo }}</li>
        @endif
    @endforeach
  </ul>

  <h2 class="reglamento-title">Anuncios</h2>
  <ul>
    @foreach($publicaciones as $publicacion)
      @if($publicacion->tipo == 'Anuncio')
        
        <li title="{{ $publicacion->titulo }}" class="truncate">{{ $publicacion->titulo }}</li>
      @endif
    @endforeach
  </ul>
</div>
</div>

<!--<div class="announcements">
<h2 class="reglamento-title">Anuncios</h2>
  <ul>
    @foreach($publicaciones as $publicacion)
      @if($publicacion->tipo == 'Anuncio')
        <li>{{ $publicacion->fecha_creacion }}</li>
        <li title="{{ $publicacion->titulo }}" class="truncate">{{ $publicacion->titulo }}</li>
      @endif
    @endforeach
  </ul>
</div>-->
</body>
</html>

@endsection