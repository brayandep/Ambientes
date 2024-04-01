<!--@extends('layoutes.plantilla')
@section('links')*/-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Ambientes</title>
    <!-- Agrega aquí tus enlaces a CSS si los necesitas -->
    <style>
        
        form {
            margin: 0 auto; /* Establece márgenes superior e inferior a 0 y centra horizontalmente */
            width: 80%; /* Ajusta el ancho del formulario según sea necesario */
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
