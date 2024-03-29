<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Lateral</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('js/script.js') }}">
</head>
<body class="fondo">
  <!-- Botón de Hamburguesa -->
  <div class="menu-btn" onclick="toggleMenu()">
    <div class="btn-line"></div>
    <div class="btn-line"></div>
    <div class="btn-line"></div>
  </div>
  
  <!-- Menú Lateral -->
  <div class="sidebar">
     <p></p>
    <div class="contenido">
        <a href="#">Gestionar Ambientes</a>
     <br>
     <a href="{{ route('Login') }}">Solicitar Reserva</a>
     <br>
         <a href="/SolicitudAmbiente">Gestionar Unidades</a>
     </div> 

    
  </div>
  
  <!-- Contenido Principal -->
  <div class="content">
    <!-- Aquí va tu contenido principal -->
  </div>

  <script src="{{asset('js/script.js')}}"></script>
</body>
</html>