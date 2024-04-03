@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
@endsection


@section('titulo', 'Formulario de Solicitud')


@section('contenido')

<h2 class="titulo">Lista de Solicitudes</h2>
<div>
    <select class="input2" id="usuario" name="usuario"  onchange="filtrarSolicitudes()">
        <option>Selecciona un usuario </option>
        @foreach($usuarios as $usuario)
          <option value="{{ $usuario->nombre}}" {{ isset($nombre) ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
        @endforeach
         
      </select>
</div>

<table  id="tablaSolicitudes" class="centro" border="1">
    <thead>
        <tr class="colorcolumna">
            <th>Nro</th>
            <th>Usuario</th>
            <th>Número de Aula</th>
            <th>Motivo</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitudes as $solicitud)
        <tr class="contentcolumna" data-usuario="{{ $solicitud->usuario }}">
            <td>{{ $solicitud->idsolicitud }}</td>
            <td>{{ $solicitud->usuario }}</td>
            <td>{{ $solicitud->nro_aula }}</td>
            <td>{{ $solicitud->motivo }}</td>
            <td>{{ $solicitud->fecha }}</td>
            <td>{{ $solicitud->horario }}</td>
            <td>
                
                <div class="botones-container">
                    <a  class="botonedit" href="{{ route('solicitud.edit', $solicitud->idsolicitud) }}">Modificar</a>
                    <form action="{{ route('solicitud.destroy', $solicitud->idsolicitud) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="botones" type="submit">Cancelar</button>
                    </form>
                </div>
               
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    function filtrarSolicitudes() {
        var seleccionado = document.getElementById("usuario").value;
        var filas = document.querySelectorAll("#tablaSolicitudes tbody tr");
        
        filas.forEach(function(fila) {
            if (fila.getAttribute("data-usuario") === seleccionado || seleccionado === "Selecciona un usuario") {
                fila.style.display = "table-row";
            } else {
                fila.style.display = "none";
            }
        });
    }
</script>
@endsection







