<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ambientes Registrados</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/AmbientesRegistrados.css') }}">
</head>
<body class="fondo">
  <!-- Título -->
  <h1 class="titulo">Ver Ambientes Registrados</h1>

  <!-- Tabla de Ambientes -->
  <table class="tabla">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Capacidad</th>
        <th>Equipos disponibles</th>
        <th>Día</th>
        <th>Fecha</th>
        <th>Horas</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <!-- Iterar sobre los ambientes y mostrarlos en la tabla -->
      @foreach ($ambientes as $ambiente)
      <tr>
        <td>{{ $ambiente->nombre }}</td>
        <td>{{ $ambiente->capacidad }}</td>
        <td>{{ $ambiente->equipos_disponibles }}</td>
        <td>{{ $ambiente->dia }}</td>
        <td>{{ $ambiente->fecha }}</td>
        <td>{{ $ambiente->horas }}</td>
        <td>
          <!-- Formulario para cambiar el estado del ambiente -->
          <form method="POST" action="{{ route('cambiar.estado') }}">
            @csrf
            <input type="hidden" name="ambiente_id" value="{{ $ambiente->id }}">
            <input type="hidden" name="nuevo_estado" value="{{ $ambiente->estadoAmbiente == 0 ? 1 : 0 }}">
            <button type="submit" class="btn btn-primary">{{ $ambiente->estadoAmbiente == 0 ? 'Habilitar' : 'Deshabilitar' }}</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
