@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/styleGrupo.css') }}">

@endsection

@section('titulo', 'Formulario de Solicitud')

@section('contenido')
<div class="contenedor1">
    <div class="NavegacionContenido">
        <div class="navegacion">
        Inicio > Gestionar mis solicitudes > Formulario de solicitud
        <h2 class="titulo">Formulario de Solicitud</h2>
        </div>
    </div>

    <form class="container2" method="POST" action="{{ route('solicitud.store') }}">
        @csrf <!-- Incluye el campo csrf aquí -->
        <div class="izqDer">
            <div class="izq">
                <div>
                    <label class="texto" for="nro_aula">Solicitante:</label><br>
                    <select class="input" id="usuario" name="usuario">
                        <option>Selecciona un usuario </option>
                        @foreach($docentes as $docente)
                        <option value="{{ $docente->nombreDocente}}" {{ isset($nombreDocente) ? 'selected' : '' }}>{{ $docente->nombreDocente }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <br>
                <div>
                    <label class="texto" for="materia">Materia:</label><br>
                    <input class="input" type="text" id="materia" name="materia" required>
                </div>
                <br>
                <div>
                    <label class="texto" for="grupo">Nro Grupo:</label><br>
                    <input class="input" type="text" id="grupo" name="grupo" required>
                </div>
                <br>
                <div>
                    <label class="texto" for="motivo">Motivo:</label><br>
                    <select class="input" id="motivo" name="motivo" required>
                        <option value="Examen">Examen</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>    
            </div>
            <div class="der">
                <div>
                    <label class="texto" for="fecha">Fecha:</label><br>
                    <input class="input" type="date" id="fecha" name="fecha" required>
                </div>
                <br>
                <div>
                    <label class="texto" for="nro_aula">Ambiente:</label><br>
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
                <div>
                    <label class="texto" for="horario">Horario:</label><br>
                    <select class="input" id="horario" name="horario">
                        <option>Selecciona un horario:</option>
                    </select>
                </div>
            </div>
        </div>
        <div>
            <button class="boton" type="submit">Enviar Solicitud</button> 
       </div>
    </form>  
      
</div>    


<script>
    //cambios de jhosemar (yo xd)
    var fechaInput = document.getElementById("fecha");
    fechaInput.addEventListener("change", function() {
        // Obtener la fecha seleccionada
        var fechaSeleccionada = new Date(fechaInput.value);
        var diasPermitidos = @json($diasUnicos);

        if (!diasPermitidos.includes(fechaSeleccionada.toLocaleDateString('es-ES', { weekday: 'long' }))) {
            alert("Por favor, selecciona una fecha permitida.");
            fechaInput.value = ""; // Restablecer el valor del input
        }

        // Verificar si la fecha seleccionada es lunes o miércoles
        // if (fechaSeleccionada.getDay() !== 0 && fechaSeleccionada.getDay() !== 2) {
        //     alert("Por favor, selecciona un lunes o miércoles.");
        //     // Restablecer el valor del campo de entrada
        //     fechaInput.value = "";
        // }
    });




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