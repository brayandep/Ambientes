<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
    <iframe src="sliderBar.blade.php" width="100%" height="100"></iframe>
    <title>Formulario de Solicitud</title>
</head>

<body>
    <h2 class="titulo">Editar Solicitud</h2>
   <div >
    <form class="container" method="POST" action="{{ route('solicitud.update',$solicitud) }}">

            @csrf <!-- Incluye el campo csrf aquí -->
            @method('put')
            <div class="izq">
                <label class="text" for="usuario">Usuario:</label><br>
                <input class="input" type="text" id="usuario" value="{{$solicitud->usuario}}" name="usuario" required>
                <br>
                <br>
                <br>
                <div>
                    <label class="text" for="nro_aula">Número de Aula:</label><br>
                    <input class="input" type="text" id="nro_aula" name="nro_aula" value="{{$solicitud->nro_aula}}" required>
                </div>
                <br>
                <br>
                <div>
                    <label class="text" for="materia">Materia:</label><br>
                    <input class="input" type="text" id="materia" name="materia" value="{{$solicitud->materia}}" required>
                </div>
                <br>
                <br>
            </div>
            <div class="der">
                <div>
                    <label for="grupo">Grupo:</label><br>
                    <input class="input" type="text" id="grupo" name="grupo" value="{{$solicitud->grupo}}" required>
                </div>
                <br>
                <br>
                <div>
                    <label class="text" for="motivo">Motivo:</label><br>
                    <select class="input" id="motivo" name="motivo" value="{{$solicitud->motivo}}" required>
                        <option value="Clase">Clase</option>
                        <option value="Examen">Examen</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <br>
                <br>
                <div>
                    <label class="text" for="fecha">Fecha:</label><br>
                    <input class="input" type="date" id="fecha" name="fecha"  value="{{$solicitud->fecha}}" required>
                </div>
                <br>
                <div>
                    <label class="text" for="horario">Horario:</label><br>
                    <input class="input" type="text" id="horario" name="horario" placeholder="HH:MM - HH:MM"  value="{{$solicitud->horario}}"required>
                </div>
                <br>
            </div>
            <button class="boton" type="submit">Actualizar Solicitud</button>   
        </form>  
   </div>    
</body>
</html>
