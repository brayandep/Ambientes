<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/stylePlantilla.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('links')
    <title>@yield('titulo')</title>
</head>
@yield('estilos')
<body>
    <div class="contenedor">
        <div class="izquierda" id="menu">
            <nav class="menu" >
                <ul>
                    <li>
                        <a href='{{ route('invitado') }}'><i class='fas fa-home'></i> Inicio</a>
                        
                    </li>
                    <li>
                        <a href="{{ route('buscador2') }}"><i class='fas fa-search'></i> Buscar</a>
                    </li>
                    <li>
                        <a href="{{ route('calendario2.index') }}"><i class='fas fa-calendar-days'></i> Calendario</a>
                    </li>
                    
                   
               
        </div>
        <div class="derecha">
            <header>
                <h1 id="btnMenu" onclick="desMenu()"><i class='fas fa-bars'></i> Menu</h1>
                <a href="{{ route('sesion.index') }}"> <i class='fas fa-user'></i></a>
             
            </header>
            
           
            <br>
            @yield('contenido')
        </div>
    </div>
    <br>
    <footer>
        <div class="footer-content">
            <img src="{{asset('images\logo.png')}}" alt="Logo" class="logo">
            
            <p class="copyright">Derechos de autor © 2024 | Todos los derechos reservados SmartByte.srl</p>
            <div class="contact-info">
                <p>Contactenos: Gmail: SmartByte@gmail.com</p>
                <p>Celular: 6954890</p>
            </div>
        </div>          
    </footer>
</body>
<script src="{{asset('js/scriptPlantilla.js')}}"></script>
@yield('scripts')
</html>

