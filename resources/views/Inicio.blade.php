@extends('layoutes.plantilla')

@section('contenido')
<style>
/* Estilos generales */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
.container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  border-radius: 20px;
  height: 70vh;
  padding: 20px;
  box-sizing: border-box;
}
.header {
  background-color: #D8BFE3;
  padding: 20px;
  border-radius: 20px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.sidebar {
  background-color: #f0f0f0;
  padding: 5px;
  width: 20%;
  border-radius: 20px;
  overflow: hidden;
  box-sizing: border-box;
}
.announcements {
  background-color: #f0f0f0;
  padding: 20px;
  border-radius: 20px;
  margin-top: 20px;
  box-sizing: border-box;
}
.announcements ul li {
  margin-bottom: 15px;
  list-style: none;
  padding-right: 20px;
  word-wrap: break-word;
}
.header img {
  width: 100%;
  max-width: 600px;
  height: auto;
  margin-left: 0;
  border-radius: 20px;
}
.header h1 {
  margin: 10px;
  font-size: 24px;
  font-weight: bold;
}
.header p {
  margin: 10px;
  font-size: 20px;
  font-weight: bold;
}
.header-text {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.reglamento {
  background-color: #933864;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 20px;
  font-weight: bold;
  text-overflow: ellipsis;
}
.reglamento-title {
  color: #FFFFFF;
  font-size: 24px;
  font-weight: bold;
  text-overflow: ellipsis;
}
.link-publicacion {
  color: blue;
  text-decoration: none;
  font-weight: bold;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Estilos para pantallas pequeñas */
@media (max-width: 768px) {
  .container {
    flex-direction: column;
    height: auto;
    padding: 10px;
  }
  .sidebar {
    width: 100%;
    margin-top: 20px;
    overflow: auto; /* Permite el desplazamiento en dispositivos móviles */
  }
  .header {
    padding: 10px;
  }
  .header img {
    width: 100%;
    margin-left: 0;
  }
  .header h1, .header p {
    text-align: center;
  }
  .reglamento-title {
    font-size: 16px; 
    padding: 5px; 
  }
  .link-publicacion {
    font-size: 14px; 
  }
}

/* Estilos para pantallas medianas (tabletas) */
@media (min-width: 769px) and (max-width: 1024px) {
  .container {
    flex-direction: column;
    height: auto;
    padding: 15px;
  }
  .sidebar {
    width: 100%;
    margin-top: 20px;
    overflow: auto; /* Permite el desplazamiento en dispositivos móviles */
  }
  .header {
    padding: 15px;
  }
  .header img {
    width: 100%;
    margin-left: 0;
  }
  .header h1, .header p {
    text-align: center;
  }
  .reglamento-title {
    font-size: 18px; 
    padding: 5px; 
  }
  .link-publicacion {
    font-size: 16px; 
  }
}

</style>

<div class="container">
  <div class="header">
    <img src="{{ asset('images/inicio.jpg') }}" alt="Logo de la Universidad">
    <div class="header-text">
      <h1>Reserva de Ambientes</h1>
      <p>Facultad de Ciencias y Tecnología</p>
    </div>
  </div>

  <div class="sidebar">
    <div class="announcements">
      <div class="reglamento">
        <h2 class="reglamento-title">Reglamento</h2>
      </div>
      <ul>
        @foreach($publicaciones as $publicacion)
          @if($publicacion->visible && $publicacion->tipo == 'reglamento')
            <li><a href="{{ route('publicacion.ver', $publicacion->id) }}" class="link-publicacion">{{ $publicacion->titulo }}</a></li>
          @endif
        @endforeach
      </ul>
      <div class="reglamento">
        <h2 class="reglamento-title">Anuncios</h2>
      </div>
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
