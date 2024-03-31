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
        width: 65px; 
        height: auto; 
        margin-right: 10px; 
        }
        .footer-content img {
          max-width: 50px; 
        }
        .footer-content {
        align-items: center; 
        display: inline-flex;
        justify-content: space-between;
        }  
        .contact-info {
            margin-left: 100px; 
            line-height: 0; /* Ajusta la altura de línea */
        }

        /* Media query para dispositivos con un ancho máximo de 768px (típicamente dispositivos móviles) */
        @media only screen and (max-width: 768px) {
            .contact-info {
                margin-left: 0; 
                text-align: center; 
                line-height: 1; 
            }
        }
        .main-content {
            transition: margin-left 0.3s ease; /* Agrega una transición suave para el desplazamiento */
            margin-left: 0; /* Establece el margen izquierdo inicial */
        }

    </style>
</head>
<body>
   
    
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
    

</body>
</html>
