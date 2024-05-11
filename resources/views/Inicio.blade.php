@extends('layoutes.plantilla')

@section('contenido')
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .container {
    display: flex; /* Utilizamos flexbox */
    flex-direction: row; /* Dirección horizontal */
    justify-content: space-between; /* Distribuye los elementos a lo largo del contenedor */
    border-radius: 20px;
    height: 70vh;/*toda la pantalla verticalmente*/
  }
  .header {
    background-color: #D8BFE3;
    padding: 20px;
    align-items: center; /* Centramos verticalmente */
    border-radius: 20px;
    flex-grow: 1;
    display: flex;
  }
  .sidebar {
    background-color: #f0f0f0;
    padding: 5px;
    width: 20%;
    overflow: hidden; /* Para ocultar cualquier texto que se desborde */
    white-space: nowrap; /* Para evitar que el texto se divida en varias líneas */
    border-radius: 20px;
  }
  .announcements {
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 20px;
    margin-top: 20px;
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
    font-size: 24px;
    font-weight: bold;
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
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: bold;
    
  }
  .link-publicacion {
    color: blue;
    text-decoration: none; /* Quita el subrayado predeterminado del enlace */
    font-weight: bold;
    white-space: nowrap; /* Evita que el texto se divida en varias líneas */
    overflow: hidden; /* Oculta cualquier contenido que desborde del contenedor */
    text-overflow: ellipsis;
}
</style>
@section('contenido')
<div class="container">
  <div class="header">
    <img src="{{asset('images\inicio.jpg')}}" alt="Logo de la Universidad">
    <div class="header-text">
      <h1>Reserva de Ambientes</h1>
      <p>Facultad de Ciencias y Tecnología</p>
    </div>
  </div>

  @foreach($publicaciones as $publicacion)
    @if($publicacion->fecha_vencimiento <= now()) <!-- Compara la fecha de vencimiento con la fecha actual -->
        <!-- Aquí establece la columna visible a 0 -->
        @if($publicacion->visible == 1) <!-- Solo si actualmente es visible -->
            <?php $publicacion->update(['visible' => 0]); ?> <!-- Actualiza la columna visible a 0 -->
        @endif
    @endif
  @endforeach

  <div class="sidebar">
    <div class="announcements">
      <h2 class="reglamento-title">Reglamento</h2>
      <ul>
        @foreach($publicaciones as $publicacion)
          @if($publicacion->visible && $publicacion->tipo == 'reglamento')
            <li><a href="{{ route('publicacion.ver', $publicacion->id) }}" class="link-publicacion">{{ $publicacion->titulo }}</a></li>
          @endif
        @endforeach
      </ul>

      <h2 class="reglamento-title">Anuncios</h2>
      <ul>
        @foreach($publicaciones as $publicacion)
          @if($publicacion->visible && $publicacion->tipo == 'anuncio')
            <li><a href="{{ route('publicacion.ver', $publicacion->id) }}" class="link-publicacion">{{ $publicacion->titulo }}</a></li>
          @endif
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
