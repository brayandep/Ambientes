@extends('layoutes.plantilla')

@section('titulo', 'Calendario Individual')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/calendario.css')}}">
@show

@section('contenido')
    <div class="cont1" id="cont1">
        <div class="cont2">
            <div class="navegacion">
                <P>Inicio > Ambiente > Calendario</P>
                <h1><i class='fas fa-calendar-days'></i> Calendario - Ambiente</h1>
            </div>
            <div id='calendar'></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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
    <script src="{{asset('js/calendarioIndividual.js')}}"></script>
@endsection