<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/styleMateria.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>SmartByte</title>
</head>
<body>
    <div class="contenedor">
        <div class="izquierda">
            <h1><i class='fas fa-bars'></i> Menu</h1>
            <nav class="menu">
                <ul>
                    <li>
                        <a href="#"><i class='fas fa-home'></i> Inicio</a>
                        
                    </li>
                    <li>
                        <a href="#"><i class='fas fa-search'></i> Buscar</a>
                    </li>
                    <li onclick="gesAmbiente()">
                        <p><i class='fas fa-clipboard'></i> Gestionar Ambiente</p>
                        
                    </li>
                    <nav class="subMenu" id="sub1">
                        <ul>
                            <li>
                                <a href="#"><i class='fas fa-clipboard'></i> Registrar Ambiente</a>
                            </li>
                            <li>
                                <a href="#"><i class='fas fa-pen-to-square'></i> Editar Informacion de ambiente</a>
                            </li>
                        </ul>
                    </nav>
                    <li onclick="gesUnidad()">
                        <p><i class='fas fa-clipboard'></i> Registrar Nueva Unidad</p>
                    </li>
                    <nav class="subMenu" id="sub2">
                        <ul>
                            <li>
                                <a href="#"><i class="fas fa-building"></i> Registrar Facultad</a>
                            </li>
                            <li>
                                <a href="#"><i class='fas fa-graduation-cap'></i> Registrar Carrera</a>
                            </li>
                            <li>
                                <a href="#"><i class='fas fa-book'></i> Registrar Materia</a>
                            </li>
                            <li>
                                <a href="#"><i class="fas fa-user-group"></i> Registrar Grupo</a>
                            </li>
                        </ul>
                    </nav>
                    <li>
                        <p><i class='fas fa-clipboard'></i> Solicitar Reserva</p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="derecha">
            <header>
                <p>header</p>
            </header>
            <main>
                <div>
                    <h1><i class='fas fa-graduation-cap'></i> Registrar Carrera</h1>
                </div>
            </main>
        </div>
    </div>
</body>
<script src="{{asset('js/scriptMateria.js')}}"></script>
</html>

