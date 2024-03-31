<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <iframe src="sliderBar.blade.php" width="100%" height="100"></iframe>
    <title>Formulario de Solicitud</title>
</head>

<body>
    <h2 class="titulo">Formulario de Solicitud</h2>
   <div class="container">
    <form method="POST" action="{{ route('solicitud.store') }}">

            @csrf <!-- Incluye el campo csrf aquí -->
            <div class="izq">
                <label class="text" for="usuario">Usuario:</label><br>
                <input class="input" type="text" id="usuario" name="usuario" required>
                <br>
                <br>
                <br>
                <div>
                    <label class="text" for="nro_aula">Número de Aula:</label><br>
                    <input class="input" type="text" id="nro_aula" name="nro_aula" required>
                </div>
                <br>
                <br>
                <div>
                    <label class="text" for="materia">Materia:</label><br>
                    <input class="input" type="text" id="materia" name="materia" required>
                </div>
                <br>
                <br>
            </div>
            <div class="der">
                <div>
                    <label for="grupo">Grupo:</label><br>
                    <input class="input" type="text" id="grupo" name="grupo" required>
                </div>
                <br>
                <br>
                <div>
                    <label class="text" for="motivo">Motivo:</label><br>
                    <select class="input" id="motivo" name="motivo" required>
                        <option value="Clase">Clase</option>
                        <option value="Examen">Examen</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <br>
                <br>
                <div>
                    <label class="text" for="fecha">Fecha:</label><br>
                    <input class="input" type="date" id="fecha" name="fecha" required>
                </div>
                <br>
                <div>
                    <label class="text" for="horario">Horario:</label><br>
                    <input class="input" type="text" id="horario" name="horario" placeholder="HH:MM - HH:MM" required>
                </div>
                <br>
            </div>
            <button class="boton" type="submit">Enviar Solicitud</button>   
        </form>  
   </div>    
</body>
</html>
