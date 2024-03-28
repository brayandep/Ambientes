<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Ambientes</title>
    <!-- Agrega aquí tus enlaces a CSS si los necesitas -->
</head>
<body>
    <h1>Buscar Ambientes</h1>
    <form action="{{ route('ambientes.buscar') }}" method="POST">
       Nombre del ambiente:
        <input type="text" name="nombre" placeholder="Nombre del ambiente">
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
        <button type="submit">Buscar</button>
    </form>
    <!-- Puedes agregar más contenido aquí si lo necesitas -->
</body>
</html>
