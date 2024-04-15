@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
@endsection


@section('titulo', 'Formulario de Solicitud')


@section('contenido')



<h2 class="titulo">Editar Solicitud</h2>
<div >
 <form class="container2" method="POST" action="{{ route('solicitud.update',$solicitud) }}">

         @csrf <!-- Incluye el campo csrf aquí -->
         @method('put')
         <div class="izq">
             <label class="text" for="usuario">Usuario:</label><br>
             <input class="input" type="text" id="usuario" value="{{$solicitud->usuario}}" name="usuario"  readonly required >
             <br>
             <br>

             <div>
                <label class="text" for="materia">Materia:</label><br>
                <input class="input" type="text" id="materia" name="materia" value="{{$solicitud->materia}}" required>
            </div>
    
             <br>
             <br>
             <div>
                <label for="grupo">Nro Grupo:</label><br>
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
             <br>
            
           
         </div>



         <div class="der">
            <div>
                <label class="text" for="fecha">Fecha:</label><br>
                <input class="input" type="date" id="fecha" name="fecha"  value="{{$solicitud->fecha}}" required>
            </div>
            
             <br>
             <br>

             <div>
                <label class="text" for="nro_aula">Ambiente:</label><br>
                <select class="input" id="nro_aula" name="nro_aula">
                    <option>Selecciona un ambiente</option>
                    @foreach($ambientes as $ambiente)
                        <option value="{{ $ambiente->id }}" {{ $idAmbienteSeleccionado == $ambiente->id ? 'selected' : '' }}>
                            {{ $ambiente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

             <br>
             <br>
             <div>
                <label class="text" for="horario">Horario:</label><br>
                <select class="input" id="horario" name="horario" value="{{$solicitud->horario}}">
                    <option></option>
                </select>
            </div>
            <br>
            <br>
        </div>
            
         </div>
         <button class="botonupdate" type="submit">Actualizar Solicitud</button>   
     </form>  
</div>    



<script>
    document.getElementById('nro_aula').addEventListener('change', function() {
        var selectedAmbienteId = this.value;
        // Limpiar el select de horario
        document.getElementById('horario').innerHTML = '<option>Selecciona un horario:</option>';
        // Filtrar los horarios correspondientes al ambiente seleccionado
        var horarios = {!! json_encode($horarios->toArray()) !!};
        var horariosFiltrados = horarios.filter(function(horario) {
            return horario.ambiente_id == selectedAmbienteId;
        });
        // Agregar las opciones al select de horario
        var horarioSelect = document.getElementById('horario');
        horariosFiltrados.forEach(function(horario) {
            var option = document.createElement('option');
            // Modificar el valor del option para que sea el contenido deseado
            var horarioText = horario.horaInicio + ' - ' + horario.horaFin;
            option.value = horarioText;
            option.text = horarioText;
            horarioSelect.appendChild(option);
        });
    });
</script>

@endsection