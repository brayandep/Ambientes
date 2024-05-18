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
        @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif    
        </div>
    </div>
   
    <form class="container2" method="POST" action="{{ route('solicitud.store') }}">
        @csrf <!-- Incluye el campo csrf aquí -->
        <div class="izqDer">
            <div class="izq">
                <div>
                    <label class="texto" for="nro_aula">Solicitante:</label><br>
                    <input type="hidden" id="usuarioId" name="usuario" value="{{ $usuario->id }}">
                    <input type="hidden" id="usuarioId" name="nombre" value="{{ $usuario->nombre }}">
                    <input type="text" class="input" id="solicitanteNombre" value="{{ $usuario->nombre }}" readonly>
                    
                    
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
                    <label class="texto" for="nro_aula">Ambiente:</label><br>
                    <select class="input" id="nro_aula" name="nro_aula">
                        <option>Selecciona un ambiente</option>
                        @foreach($ambientes as $ambiente)
                            <option value="{{ $ambiente->id }}" {{ isset($id) && $id == $ambiente->id ? 'selected' : '' }}>
                                {{ $ambiente->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div id="diasAmbiente"></div>
                </div>
                <br>
                <div>
                    <label class="texto" for="fecha">Fecha:</label><br>
                    <input class="input" type="date" id="fecha" name="fecha" required>
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
    var diasPermitidos = [];
    document.getElementById('nro_aula').addEventListener('change', function() {
        var selectedAmbienteId = this.value;
        // Limpiar el select de horario
        document.getElementById('horario').innerHTML = '<option>Selecciona un horario:</option>';
        // Filtrar los horarios correspondientes al ambiente seleccionado
        var horarios = {!! json_encode($horarios->toArray()) !!};
        var horariosFiltrados = horarios.filter(function(horario) {
            return horario.ambiente_id == selectedAmbienteId;
        });

        //Cambios de Jhosemar: saca los dias del ambiente seleccionado y lo filtra a fecha
        
        var diasYaAgregados = {};
        diasPermitidos = [];
        horariosFiltrados.forEach(function(horario) {
            if (!diasYaAgregados[horario.dia]) {
            diasPermitidos.push(horario.dia);
            diasYaAgregados[horario.dia] = true; // Marcar el día como agregado
            }
        });
        console.log(diasPermitidos);

        var diasDiv = document.getElementById('diasAmbiente');
        diasDiv.innerHTML = '';
        diasDiv.innerHTML = '<p>Dias habilitados:</p>';
        var nombresDias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        diasPermitidos.forEach(function(numeroDia) {
            var nombreDia = nombresDias[numeroDia - 1]; // Restar 1 porque los arrays en JavaScript comienzan desde el índice 0
            var nuevoElemento = document.createElement('p');
            nuevoElemento.textContent = nombreDia;
            diasDiv.appendChild(nuevoElemento);
        });
        //termina cambios de Jhosemar :)

    });

    /*cambios de jhosemar (yo xd)
    esto hace que solo se permita elegir fechas que el ambiente permite*/
    var fechaInput = document.getElementById("fecha");
    fechaInput.addEventListener("change", function() {
        // Obtener la fecha seleccionada
        var fechaSeleccionada = new Date(fechaInput.value);
        var diaSeleccionado = (fechaSeleccionada.getDay()+1);

        console.log(diaSeleccionado);
        //Verificar si la fecha es correcta
        if (!diasPermitidos.includes(diaSeleccionado.toString())) {
            alert("Por favor, selecciona una fecha permitida.");
            fechaInput.value = ""; // Restablecer el valor del input
        }
    });
    //termina cambios de Jhosemar
</script>
<script>
    // Función para filtrar dinámicamente los horarios disponibles
    function filtrarHorarios() {
        // Obtén el valor seleccionado del aula
        var aulaSeleccionada = document.getElementById('nro_aula').value;
        // Obtén la fecha seleccionada
        var fechaSeleccionada = document.getElementById('fecha').value;
        // Obtén el día de la semana de la fecha seleccionada (0: Domingo, 1: Lunes, ..., 6: Sábado)
        var diaSeleccionado = new Date(fechaSeleccionada).getDay() + 1; // Ajusta el índice del día (0-6) a (1-7)

        // Obtén todos los horarios disponibles
        var horarios = {!! json_encode($horarios->toArray()) !!};

        // Filtra los horarios según el aula y el día de la semana
        var horariosFiltrados = horarios.filter(function(horario) {
            return horario.ambiente_id == aulaSeleccionada && horario.dia == diaSeleccionado;
        });

        // Actualiza las opciones del campo de selección de horarios con los horarios filtrados
        var horarioSelect = document.getElementById('horario');
        horarioSelect.innerHTML = '<option value="">Selecciona un horario:</option>';
        horariosFiltrados.forEach(function(horario) {
            var option = document.createElement('option');
            // Asigna directamente el horario como un string (horaInicio - horaFin)
            option.value = horario.horaInicio + ' - ' + horario.horaFin;
            option.textContent = horario.horaInicio + ' - ' + horario.horaFin; // Asigna el texto del horario
            horarioSelect.appendChild(option);
        });
    }

    // Agrega un evento change al campo de selección del aula
    document.getElementById('nro_aula').addEventListener('change', filtrarHorarios);
    // Agrega un evento change al campo de selección de fecha
    document.getElementById('fecha').addEventListener('change', filtrarHorarios);
</script>

@endsection