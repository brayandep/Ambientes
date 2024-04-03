<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('js/script.js') }}">
   <header class="arriba">
    <h1> </h1>
    <nav>
        <!-- Aquí va tu menú de navegación para el encabezado superior -->
    </nav>
</header>
<style>
  .botones-extras {
    display: none; /* Oculta los botones adicionales por defecto */
  }
</style>
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
                  <a class = "botones" href="#" onclick="toggleBotones()">Gestionar Ambientes</a>
              <br><div class="botones-extras">
                <!-- Botones adicionales -->
                <br>
                <a class="botones2" href="{{ route('SolicitudAmbiente') }}">Solicitar Reserva</a>
                <br>
                <a class="botones2" href="{{ route('VerSolicitud') }}">Ver mis solicitudes</a>
              </div>


          <a class = "botones" href="{{ route('SolicitudAmbiente') }}">Solicitar Reserva</a>
          <br>
              <a class = "botones" href="/SolicitudAmbiente">Gestionar Unidades</a>
     </div> 

    
  </div>
  
  <!-- Contenido Principal -->
  <div class="content">
    <!-- Aquí va tu contenido principal -->
  </div>

  <script src="{{asset('js/script.js')}}"></script>
  <script>
    function toggleBotones() {
      var botonesExtras = document.querySelector('.botones-extras');
      botonesExtras.style.display = (botonesExtras.style.display === 'none') ? 'block' : 'none';
    }
  </script>
  

</body>

<!-- PRUEBA DE OPCIONES QUE SE PUEDEN INCREMENTAR -->
<select id="opciones">
    <option value="opcion1">Opción 1</option>
    <option value="opcion2">Opción 2</option>
    <option value="opcion3">Opción 3</option>
    <option value="otro">Otro</option>
</select>
<input type="text" id="otroCampo" style="display: none;">
<button onclick="agregarNuevaOpcion()">Agregar nueva opción</button>

// Función para manejar la selección de "Otro"
<script>
function handleOtro() {
    var select = document.getElementById("opciones");
    var otroCampo = document.getElementById("otroCampo");
    if (select.value === "otro") {
        otroCampo.style.display = "inline-block";
    } else {
        otroCampo.style.display = "none";
    }
}

// Función para agregar una nueva opción
function agregarNuevaOpcion() {
    var select = document.getElementById("opciones");
    var otroCampo = document.getElementById("otroCampo");
    var nuevoValor = otroCampo.value.trim();
    if (nuevoValor !== "") {
        var nuevaOpcion = document.createElement("option");
        nuevaOpcion.value = nuevoValor;
        nuevaOpcion.text = nuevoValor;
        select.add(nuevaOpcion);
        otroCampo.value = ""; // Limpiar el campo de texto
        otroCampo.style.display = "none"; // Ocultar el campo de texto
    }
}

// Escuchar los cambios en el select
document.getElementById("opciones").addEventListener("change", handleOtro);
</script>
</html>