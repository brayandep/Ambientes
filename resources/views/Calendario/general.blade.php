@extends('layoutes.plantilla')

@section('titulo', 'Calendario General')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/calendario.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@show

@section('contenido')
    <div class="cont1" id="cont1">
        <div class="cont2">
            <div class="navegacion">
                <P>Inicio > Calendario General</P>
                <h1><i class='fas fa-calendar-days'></i> Calendario</h1>
            </div>
            <div id='calendar'></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del evento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="labEvento">Titulo</label>
                <input type="text" name="titulo" id="titulo" class="inputEvento">
                <label class="labEvento">Descripcion</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                <label class="labEvento">Fecha</label>
                <input type="text" name="fechaStart" id="fechaStart" class="inputEvento">
                <label class="labEvento">Hora</label>
                <input type="time" name="horaStart" id="horaStart" class="inputEvento">
                <label class="labEvento">Fecha final</label>
                <input type="date" name="fechaEnd" id="fechaEnd" class="inputEvento" min="{{ date('Y-m-d') }}">
                <label class="labEvento">Hora Final</label>
                <input type="time" name="horaEnd" id="horaEnd" class="inputEvento">
                <label class="labEvento">Color</label>
                <input type="color" name="color" id="color" class="inputEvento">
            </div>
            <div class="modal-footer">
                <button id="btnAgregar" class="btn btn-success">Agregar</button>
                <button id="btnModificar" class="btn btn-warning">Modificar</button>
                <button id="btnEliminar" class="btn btn-danger">Eliminar</button>
                <button id="btnCancelar" class="btn btn-default">Cancelar</button>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@6.1.11/index.global.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('js/calendario.js')}}"></script>
@endsection