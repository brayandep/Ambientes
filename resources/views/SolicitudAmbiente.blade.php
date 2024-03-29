<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitud</title>
</head>
<body>
    <h2>Formulario de Solicitud</h2>
   
        @csrf
        <div>
        <div>
            <label for="usuario">Usuario:</label><br>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div>
                <label for="nro_aula">Número de Aula:</label><br>
                <input type="text" id="nro_aula" name="nro_aula" required>
            </div>
            <div>
                <label for="materia">Materia:</label><br>
                <input type="text" id="materia" name="materia" required>
            </div>

      </div>
        <div>
            <label for="grupo">Grupo:</label><br>
            <input type="text" id="grupo" name="grupo" required>
        </div>
        <div>
            <label for="motivo">Motivo:</label><br>
            <select id="motivo" name="motivo" required>
                <option value="Clase">Clase</option>
                <option value="Examen">Examen</option>
                <option value="Otro">Otro</option>
            </select>
        </div>
        <div>
            <label for="fecha">Fecha:</label><br>
            <input type="date" id="fecha" name="fecha" required>
        </div>
        <div>
            <label for="horario">Horario:</label><br>
            <input type="text" id="horario" name="horario" placeholder="HH:MM - HH:MM" required>
        </div>
        <button type="submit">Enviar Solicitud</button>
    </form>
</body>
</html>