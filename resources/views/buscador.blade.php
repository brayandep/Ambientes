<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Ambientes</title>
    <!-- Agrega aquí tus enlaces a CSS si los necesitas -->
    <style>
        body {
        font-family: sans-serif;
        background-color: #DED4EB; /* Cambia el color a tu preferencia */
        }
        header {
            background-color: #933864;
            color: white;
            padding: 20px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        form {
            margin: 0 auto; /* Establece márgenes superior e inferior a 0 y centra horizontalmente */
            width: 80%; /* Ajusta el ancho del formulario según sea necesario */
        }

        footer {
            background-color: #933864;
            color: white;
            padding: 10px 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .logo {
        width: 65px; /* ajusta el ancho según sea necesario */
        height: auto; /* Esto mantendrá la proporción del logo */
        margin-right: 10px; /* Espacio entre el logo y el texto */
        }
        .footer-content {
       
        align-items: center; /* Alinea verticalmente los elementos */
        display: inline-flex;
        justify-content: space-between;
        }
        .contact-info {
         margin-left: 100px; /* Agrega un margen izquierdo para separar el logo del contenido de contacto */
         line-height: 0; 
        }

        .footer-content img {
          max-width: 50px; /* Limita el ancho del logo para evitar que se extienda demasiado */
        }
        .dropdown-menu {
            /*display: none;*/
            position: absolute;
            background-color: #AE7791;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown.active .dropdown-menu {
            display: block;
        }
        .dropdown-menu a {
            color:#FFFFFF;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-menu a:hover {
            background-color: #933864;
        }
        .menu-container {
            display: flex;
            align-items: center;
        }
        .search-container {
            margin-top: 10px;
        }
        .search-container input, 
        .search-container select {
            margin-right: 10px;
        }
        .buscar-btn {
            margin-top: 30px; /* Agrega un margen superior para separar el botón de los otros elementos */
        /* Ajusta otros márgenes según sea necesario */
            margin-left: 30px;
            background-color:#933864;
            color: #ffffff;
         }
         .main-content {
            transition: margin-left 0.3s ease; /* Agrega una transición suave para el desplazamiento */
            margin-left: 0; /* Establece el margen izquierdo inicial */
        }

        .menu-open .main-content {
              margin-left: 200px; /* Desplaza el contenido hacia la derecha cuando el menú está abierto */
        }


    </style>
</head>
<body>
    <header>
            
           
        <div class="menu-container">
            <div class="dropdown" id="dropdown">
                <span id="menu-toggle">Menú</span>
                <div class="dropdown-menu" id="dropdown-menu">
                <a href="{{ route('pagina_principal') }}">Ir a la página principal</a>
                <a href="{{ route('gestion_ambiente') }}">Gestionar Ambiente</a>
                <a href="{{ route('gestion_reserva') }}">Gestionar Reserva</a>
                <a href="{{ route('buscar_ambientes') }}">Buscar</a>
                </div>
            </div>
            
        </div>
    </header>
    <div class="main-content">
        <div>
                <h1>Buscador de Ambientes</h1>
        </div>
      <form action="{{ route('ambientes.buscar') }}" method="POST">
       Nombre del ambiente:
        <input type="text" name="nombre" placeholder="Nombre del ambiente" class="search-form">
        <select name="dia">
            <option value="">Día</option>
            <option value="lunes">Lunes</option>
            <option value="lunes">Martes</option>
            <option value="lunes">Miercoles</option>
            <option value="lunes">Jueves</option>
            <option value="lunes">Viernes</option>
            <option value="sabado">Sábado</option>
        </select>
        <input type="date" name="fecha" placeholder="Fecha">
        <select name="hora_inicio">
            <option value="">Hora de inicio</option>
            <option value="08:15">06:45</option>
            <option value="08:15">08:15</option>
            <option value="08:15">09:45</option>
            <option value="08:15">11:15</option>
            <option value="08:15">12:45</option>
        </select>
        <select name="hora_fin">
            <option value="">Hora de fin</option>
            <option value="08:15">08:15</option>
            <option value="08:15">09:45</option>
            <option value="08:15">11:15</option>
            <option value="08:15">12:45</option>
            <option value="09:45">14:15</option>
            
        </select>
        <input type="number" name="capacidad" placeholder="Capacidad">
        <button type="submit"class="buscar-btn">Buscar</button>
    </form>
    </div>
    <footer>
        <div class="footer-content">
            <img src="\Ambientes\public\images\logo.png" alt="Logo" class="logo">
            
            <p class="copyright">Derechos de autor © 2024 | Todos los derechos reservados SmartByte.srl</p>
            <div class="contact-info">
                
                <p>Contactenos: Gmail: SmartByte@gmail.com</p>
                <p>Celular: 6954890</p>
            </div>
        </div>          
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const dropdownMenu = document.getElementById('dropdown-menu');

            // Función para cerrar el menú y restablecer el contenido cuando se hace clic en cualquier parte del documento
            function closeMenuAndResetContent() {
                dropdownMenu.classList.remove('active'); // Oculta el menú desplegable
                document.body.classList.remove('menu-open'); // Elimina la clase para indicar que el menú está abierto
            }

            // Agregamos un evento de clic al botón del menú
            menuToggle.addEventListener('click', function() {
                dropdownMenu.classList.toggle('active'); // Activa/desactiva el menú desplegable
                document.body.classList.toggle('menu-open'); // Agrega/elimina una clase al cuerpo para indicar si el menú está abierto
            });

            // Agregamos un manejador de eventos de clic al documento
            document.body.addEventListener('click', function(event) {
                // Verificamos si el clic no ocurrió dentro del menú o del botón de menú
                if (!dropdownMenu.contains(event.target) && event.target !== menuToggle) {
                    closeMenuAndResetContent(); // Cerramos el menú y restablecemos el contenido
                }
            });
        });
    </script>

</body>
</html>
