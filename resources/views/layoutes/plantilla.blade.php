<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/stylePlantilla.css">
    <link rel="stylesheet" href="../../css/stylelogin.css">

    <link rel="icon" href="../../images/umss.png" type="image/x-icon">
    <link rel="shortcut icon" href="../../images/umss.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('links')
    <title>@yield('titulo')</title>
</head>
@yield('estilos')

<body>
    <div class="contenedor">
        
        <div class="derecha">
            <header>
                {{-- menu --}}
                <div class="izquierda" id="menu">
                    <nav class="menu" >
                        <ul>
                            <li>
                                <a href='{{ route('inicio') }}'><i class='fas fa-home'></i> Inicio</a>
                                
                            </li>
                        
                            <li>
                                <a href="{{ route('buscador') }}"><i class='fas fa-search'></i> Buscar</a>
                            </li>
                            <li>
                                <a href="{{ route('calendario.index') }}"><i class='fas fa-calendar-days'></i> Calendario</a>
                            </li>
                            @if (Auth::check())    
                                @if (Auth::user()->can('Ver ambiente') || Auth::user()->can('Regsitrar ambiente'))
                                    <li onclick="gesAmbiente()">
                                        <p><i class='fas fa-clipboard'></i> Gestionar Ambiente</p>
                                        
                                    </li>
                                @endif
                            @endif
                            <nav class="subMenu" id="sub1">
                                <ul>
                                    @can('Registrar ambiente')   
                                    <li>
                                        <a href="{{ route('ambiente.create') }}"><i class='fas fa-clipboard'></i> Registrar Ambiente</a>
                                    </li>
                                    @endcan
                                    @can('Ver ambiente')   
                                    <li>
                                        <a href="{{ route('AmbientesRegistrados') }}"><i class="fa-solid fa-rectangle-list"></i> Ver Informacion de ambiente</a>
                                    </li>
                                    @endcan
                                </ul>
                            </nav>
        
                            @if (Auth::check())
                                @if (Auth::user()->can('Ver unidad') || Auth::user()->can('Registrar unidad'))
                                    <li onclick="gesUnidad()">
                                        <p><i class='fas fa-clipboard'></i> Gestionar Unidad</p>
                                    </li>
                                @endif
                            @endif
        
                            <nav class="subMenu" id="sub2">
                                <ul>
                                    @can('Registrar unidad') 
                                    <li>
                                        <a href='{{ route('unidad.registrar') }}'><i class="fas fa-building"></i> Registrar unidad nueva</a>
                                    </li>
                                    @endcan
                                    @can('Ver unidad') 
                                    <li>
                                        <a href='{{ route('visualizar_unidad') }}'><i class='fas fa-clipboard'></i> Visualizar unidad</a>
                                    </li>
                                    @endcan
                                </ul>
                            </nav>
        
                            @if (Auth::check())
                                @if (Auth::user()->can('Ver materia') || Auth::user()->can('Registrar materia'))
                                    <li onclick="gesMateria()">
                                        <p><i class='fas fa-clipboard'></i> Gestionar Materia</p>
                                    </li>
                                @endif
                            @endif
                            
                            <nav class="subMenu" id="subMateria">
                                <ul>
                                    @can('Registrar materia') 
                                    <li>
                                        <a href='{{ route('materia.reg') }}'><i class="fas fa-book"></i> Registrar Materia</a>
                                    </li>
                                    @endcan
                                    @can('Ver materia')
                                    <li>
                                        <a href='{{ route('materia.show') }}'><i class='fas fa-rectangle-list'></i> Lista de Materias</a>
                                    </li>
                                    @endcan
                                </ul>
                            </nav>
                            
                            @can('Solicitar ambiente')
                                <li onclick="gesReserva()">
                                    <p><i class='fas fa-clipboard'></i> Gestionar mis solicitudes</p>
                                
                                </li>
                            @endcan
                            <nav class="subMenu" id="sub3">
                                <ul>
                                    <li>
                                        <a href='{{ route('solicitud.create') }}'><i class="fas fa-building"></i> Solicitar reserva</a>
                                    </li>
                                    <li>
                                        <a href='{{ route('VerSolicitud') }}'><i class='fas fa-clipboard'></i> Ver mis solicitudes</a>
                                    </li>
                               <!-- <li>
                                        <a href="#"><i class='fas fa-book'></i> Registrar Materia</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-user-group"></i> Registrar Grupo</a>
                                    </li>-->
                                </ul>
                            </nav>
                            @can('Confirmar reserva')
                                <li >
                                    <a href='{{ route('habilitarReservas') }}'><i class='fas fa-clipboard'></i> Gestionar Reservas</a>
                                </li>
                            @endcan
                            @can('Registrar publicacion')
                                <li>
                                    <a href='{{ route('publicaciones.index') }}'><i class='fas fa-clipboard'></i> Publicaciones</a>
                                </li>
                            @endcan
        
                            @if (Auth::check())
                                @if (Auth::user()->can('Registrar usuario') || Auth::user()->can('Ver usuario'))
                                    <li onclick="gesUsuario()">
                                        <p><i class='fas fa-clipboard'></i> Gestionar Usuarios</p>
                                    </li>
                                @endif
                            @endif
        
                            <nav class="subMenu" id="subUser">
                                <ul>
                                    @can('Registrar materia') 
                                    <li>
                                        <a href='{{ route('Usuario.index') }}'><i class='fas fa-clipboard'></i> Registrar Usuario</a>
                                    </li>
                                    @endcan
                                    @can('Ver materia')
                                    <li>
                                        <a href='{{ route('Usuario.show') }}'><i class='fas fa-rectangle-list'></i> Lista de Usuarios</a>
                                    </li>
                                    @endcan
                                </ul>
                            </nav>
        
                            @if (Auth::check())    
                                @if (Auth::user()->can('Ver rol') || Auth::user()->can('Registrar rol'))
                                    <li onclick="GesRol()">
                                        <p><i class='fas fa-clipboard'></i> Gestion de roles</p>
                                    </li>
                                @endif
                            @endif
        
                            <nav class="subMenu" id="subRol">
                                <ul>
                                    @can('Registrar rol')    
                                        <li>
                                            <a href='{{ route('Formulario.Rol') }}'><i class="fas fa-book"></i> Registrar nuevo rol</a>
                                        </li>
                                    @endcan
                                    @can('Ver rol')    
                                        <li>
                                            <a href='{{ route('Rol.index') }}'><i class='fas fa-rectangle-list'></i>Visualizar roles</a>
                                        </li>
                                    @endcan
                                </ul>
                            </nav>
        
        
                            
                        </ul>
                        
                    </nav>
                </div>
                {{-- termina menu --}}
                

                <h1 id="btnMenu" onclick="desMenu()"><i class='fas fa-bars'></i> Menu </h1>
                @if (Auth::check())
                    <div class="user-menu-container">
                        <button id="userMenuButton" onclick="toggleUserMenu()"><i class='fas fa-user' style="pointer-events: none;"></i></button>
                        <div id="userMenu" class="user-menu">
                            <div class="nombreUser">
                                {{ Auth::user()->nombre }}
                                <hr>
                            </div>
                            <a href='{{ route('user.edit') }}'>Modificar usuario <i class="fas fa-edit"></i></a>
                            @can('Generar backup')
                                <a href='{{ route('backup.index') }}'>Backups <i class="fas fa-clock-rotate-left"></i></a>
                            @endcan
                            @can('Control bitacora')
                                <a href='{{ route('Log.index') }}'>Bitacoras <i class="fas fa-timeline"></i></a>
                            @endcan
                            <a href='{{ route('logout') }}'>Salir <i class="fas fa-right-from-bracket"></i></a>
                        </div>
                    </div>
                @else
                    <a href='{{ route('sesion.index') }}'><i class='fas fa-user'></i></a>
                @endif
            </header>
            <br>
            <div class="separarHeader">
                @yield('contenido')
            </div>
        </div>
    </div>
    <br>
    <footer>
        <div class="footer-content">
            <img src="{{asset('images\logo.png')}}" alt="Logo" class="logo">
            
            <p class="copyright">Derechos de autor © 2024 | Todos los derechos reservados SmartByte.SRL</p>
            <div class="contact-info">
                <p>Contactenos: Gmail: SmartByte@gmail.com</p>
                <p>Celular: 6954890 </p>
              
            </div>
           
        </div>          
    </footer>
</body>

</script>
<script>
    function toggleUserMenu() {
        console.log("toggleUserMenu called");  // Añade esta línea
        var userMenu = document.getElementById("userMenu");
        if (userMenu.style.display === "block") {
            userMenu.style.display = "none";
        } else {
            userMenu.style.display = "block";
        }
    }

    // Cerrar el menú si se hace clic fuera de él
    window.onclick = function(event) {
        if (!event.target.matches('#userMenuButton')) {
            var userMenu = document.getElementById("userMenu");
            if (userMenu.style.display === "block") {
                userMenu.style.display = "none";
            }
        }
    }
</script> 
<script src="../../js/scriptPlantilla.js"></script>
@yield('scripts')
</html>

