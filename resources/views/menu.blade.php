<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de reservas de ambientes</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('js/script.js') }}">

</head>
<body class="fondo">
  <!-- Cabecera -->
  <header class="header">
    <!-- Botón de Hamburguesa -->
    <div class="menu-btn" onclick="toggleMenu()">
      <div class="btn-line"></div>
      <div class="btn-line"></div>
      <div class="btn-line"></div>
    </div>
    <h3 class="menu-label">Menú</h3>
    <h1 class="title">Sistema de reservas de ambientes</h1>
  </header>

  <!-- Menú desplegable -->
  <nav class="menu">
    <ul>
      <li>
        <a href="#">Inicio</a>
      </li>
      <li>
        <a href="#">Gestionar ambientes</a>
        <ul>
          <li><a href="#">Sub-opción 1</a></li>
          <li><a href="#">Sub-opción 2</a></li>
          <li><a href="#">Sub-opción 3</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Gestionar unidades</a>
        <ul>
          <li><a href="#">Sub-opción 1</a></li>
          <li><a href="#">Sub-opción 2</a></li>
          <li><a href="#">Sub-opción 3</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-left">
      <!--<img src="{{ asset('images/logo.png') }}" alt="Logo de la empresa">-->
      <p>&copy; 2024 SmartByte S.R.L. Todos los derechos reservados.</p>
    </div>
    <div class="footer-right">
      <p>Contactenos:</p>
      <p>smartbyte626@gmail.com</p>
      <p>6954890</p>
    </div>
  </footer>

  <script src="{{asset('js/script.js')}}"></script>
</body>
</html>