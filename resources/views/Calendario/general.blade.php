@extends('layoutes.plantilla')

@section('titulo', 'Calendario General')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('css/calendario.css')}}"> --}}
    <link rel="stylesheet" href="css/calendario.css">
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
            <h1 class="modal-title fs-5" id="labelTitulo">Datos del evento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="idEvento" id="idEvento" class="d-none">

                <label class="labEvento" id="labTitulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" class="inputEvento">
                <span id="msgError1" class="text-danger"></span>


                <div class="caja">
                    <div class="caja2">
                        <label class="labEvento">Fecha Inicial</label>
                        <input type="date" name="fechaStart" id="fechaStart" class="inputEvento">       
                    </div>
                    <div class="caja2">
                        <label class="labEvento">Hora Inicial</label>
                        <input type="time" name="horaStart" id="horaStart" class="inputEvento" value="06:45">
                    </div>
                </div>
                <span id="msgError3" class="text-danger"></span>

                <label class="labEvento">Descripcion</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                <span id="msgError2" class="text-danger"></span>

                <div class="caja">
                    <div class="caja2">
                        <label class="labEvento">Fecha final</label>
                        <input type="date" name="fechaEnd" id="fechaEnd" class="inputEvento" >
                    </div>
                    <div class="caja2">
                        <label class="labEvento">Hora Final</label>
                        <input type="time" name="horaEnd" id="horaEnd" class="inputEvento" onchange="compararHoras()">
                    </div>
                </div>
                <span id="msgError4" class="text-danger"></span>
                <span id="alertaHora" class="text-danger"></span>

                <label class="labEvento">Color</label>
                <input type="color" name="color" id="color" class="inputEvento" value="#CD9DC0" style="width: 50%;">

            </div>
            <div class="modal-footer">
                <button id="btnAgregar" class="btn btn-success">Agregar</button>
                <button id="btnModificar" class="btn btn-warning">Modificar</button>
                <button id="btnEliminar" class="btn btn-danger">Eliminar</button>
                <button id="btnCancelar" data-bs-dismiss="modal" class="btn btn-default">Cancelar</button>
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
    {{-- <script src="{{asset('js/calendario.js')}}"></script> --}}
    <script src="js/calendario.js"></script>

    <script>
        var misEventos = @json($eventos);
        var regEvento = @json($regEvento);
        var editEvento = @json($editEvento);
        console.log(regEvento);

        function limitarFecha(){
            $('#fechaEnd').val($('#fechaStart').val());
            $('#fechaEnd').prop('min', $('#fechaStart').val());
        }

        $('#horaStart').on('change', function() {
            var horaStart = $('#horaStart').val();
            var fHoraStart = new Date('2000-01-01T' + horaStart);

            var horaLimite = new Date('2000-01-01T06:00:00');

            console.log(horaLimite);
            if (fHoraStart < horaLimite) {
                $('#horaStart').val('06:00');
            }else{
                var hora1 = $(this).val();
                $('#horaEnd').val(hora1);
            }
        });
    </script>
@endsection