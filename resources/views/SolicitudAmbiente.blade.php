@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/styleGrupo.css') }}">

@endsection

@section('titulo', 'Formulario de Solicitud')

@section('contenido')

<h2 class="titulo">Formulario de Solicitud</h2>
<div class="container">
 <form class="container" method="POST" action="{{ route('solicitud.store') }}">

         @csrf <!-- Incluye el campo csrf aquí -->
         <div class="izq">
            <br>
         <div>
            <label class="text" for="nro_aula">Solicitante:</label><br>
             <select class="input" id="usuario" name="usuario">
                 <option>Selecciona un usuario </option>
                 @foreach($usuarios as $usuario)
                   <option value="{{ $usuario->nombre}}" {{ isset($nombre) ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                 @endforeach
                  
               </select>
         </div>
         <br>
             <br>
         <div>
            <label class="text" for="materia">Materia:</label><br>
            <input class="input" type="text" id="materia" name="materia" required>
        </div>


            
             <br>
             <br>
             <div>
                <label for="grupo">Nro Grupo:</label><br>
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
             
           
         </div>



         <div class="der">

            <div>
                <label class="text" for="fecha">Fecha:</label><br>
                <input class="input" type="date" id="fecha" name="fecha" required>
            </div>
            <br>
             <br>
             <div>
                <label class="text" for="nro_aula">Ambiente:</label><br>
                <select class="input" id="nro_aula" name="nro_aula">
                    <option>Selecciona un ambiente</option>
                    @foreach($ambientes as $ambiente)
                        <option value="{{ $ambiente->id }}" {{ isset($id) && $id == $ambiente->id ? 'selected' : '' }}>
                            {{ $ambiente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            
             <br>
             <br>
             <div>
                <label class="text" for="horario">Horario:</label><br>
                <select class="input" id="horario" name="horario">
                    <option>Selecciona un horario:</option>
                </select>
            </div>
             <br>
             <br>
         </div>
      
            <button class="boton" type="submit">Enviar Solicitud</button> 
     </form>  
      
</div>    


<script>
    var fechaInput = document.getElementById('fecha');
    var hoy = new Date();
    var mañana = new Date(hoy);
    mañana.setDate(mañana.getDate() + 1); // Suma un día a la fecha actual

    var año = mañana.getFullYear();
    var mes = (mañana.getMonth() + 1).toString().padStart(2, '0');
    var día = mañana.getDate().toString().padStart(2, '0');

    var fechaMinima = año + '-' + mes + '-' + día;
    fechaInput.setAttribute('min', fechaMinima);
</script>

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