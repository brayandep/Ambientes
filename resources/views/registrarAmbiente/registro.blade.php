@extends('layoutes.plantilla')

@section('links')
    <link rel="stylesheet" type="text/css" href="/css/registroAmbiente/stylesAmbiente.css">
@endsection

@section('titulo', 'Registro de Ambiente')

@section('contenido')
<main class="content-wrapper">
            <div class="container">
            <h2 class="ambienteTitulo" style="padding-bottom:20px" ><i class='fas fa-book'></i> {{ isset($ambienteDatos) ? 'Editar Ambiente' : 'Registro de Ambiente' }}</h2>
                <form method="POST" action="{{ isset($ambienteDatos) ? route('ambiente.update', $ambienteDatos->id) : route('ambiente.store') }}">
                  @csrf
                  @if(isset($ambienteDatos))
                      @method('PUT')
                  @endif
                    
                <div class="form-group">
                    <label for="codigo">Código:</label>
                    <input type="text" id="codigo" name="codigo" style="width: 40%;" required maxlength="5" autocomplete="off" placeholder="Ingrese codigo de ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->codigo : '' }}">
                    @error('codigo')
                        <span class=msgError>*{{$message}}</span>
                    @enderror
                    <label for="unidad">Unidad:</label>
                        <select class="selectAmbiente" id="unidad" name="unidad" style="width: 40%;" required>
                        <option value="">Selecciona una unidad</option>
                        @foreach($unidades as $unidad)
                          <option value="{{ $unidad->nombreUnidad }}" {{ isset($ambienteDatos) && $ambienteDatos->unidad == $unidad->nombreUnidad ? 'selected' : '' }}>{{ $unidad->nombreUnidad }}</option>
                        @endforeach
                        </select>
                        @error('unidad')
                        <span class=msgError>*{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" style="width: 40%;"maxlength="25" required autocomplete="off" placeholder="Ingrese nombre del ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->nombre : '' }}">
                    @error('nombre')
                        <span class=msgError>*{{$message}}</span>
                    @enderror
                    <label for="capacidad">Capacidad:</label>
                    <input type="text" id="capacidad" name="capacidad" style="width: 40%;" maxlength="3" required autocomplete="off" placeholder="Ingrese capacidad de ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->capacidad : '' }}">
                    @error('capacidad')
                        <span class=msgError>*{{$message}}</span>
                    @enderror
                  </div>
    
    
    
                <div class="form-group">
                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" style="width: 40%;" required maxlength="80" autocomplete="off" placeholder="Ingrese ubicacion URL del ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->ubicacion : '' }}">
                    @error('ubicacion')
                        <span class=msgError>*{{$message}}</span>
                    @enderror
                  <label for="tipo-ambiente">Tipo de ambiente:</label>
                  <select class="selectAmbiente" id="tipo-ambiente" name="tipo-ambiente" style="width: 40%;" required onchange="verificarOtro(this)">
                    <option>Selecciona una unidad</option>
                    @foreach($tipoAmbientes as $tipoAmbiente)
                      <option value="{{ $tipoAmbiente->nombreTipo}}" {{ isset($ambienteDatos) && $ambienteDatos->tipo_ambiente_id == $tipoAmbiente->id ? 'selected' : '' }}>{{ $tipoAmbiente->nombreTipo }}</option>
                    @endforeach
                      <option value="Otro">Otro</option> <!-- Opción adicional "Otro" -->
                  </select>
                  @error('tipo-ambiente')
                        <span class=msgError>*{{$message}}</span>
                    @enderror
              </div>
    
  
  
    
  
  
                <div class="form-grupo">
                    <label for="descripcion">Descripción de ubicación:</label>
                    <textarea id="descripcion" name="descripcion" maxlength="40" required autocomplete="off">{{ isset($ambienteDatos) ? $ambienteDatos->descripcion_ubicacion : '' }}</textarea>
                    @error('descripcion')
                        <span class=msgError>*{{$message}}</span>
                    @enderror
                </div>
                
                
                
                <div class="form-grupo">
                    <label>Equipos disponibles:</label><br>
                    <div class="checkbox-columns" style="padding-left: 20px;">
                        <div class="column">
                            @foreach($equiposDisponibles as $equipo)
                                <label>
                                    <input type="checkbox" name="equipos-disponibles[]" value="{{ $equipo }}"
                                        @isset($equiposSeleccionados) 
                                            {{ in_array($equipo, $equiposSeleccionados) ? 'checked' : '' }}
                                        @endisset>
                                    {{ $equipo }}
                                </label><br>
                            @endforeach
                        </div>
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="diasSemana" style="width: 120px;">Horas hábiles:</label>
                    <select class="selectAmbiente" id="diasSemana" onchange="agregarColumna()" style="width: 20%;">
    
                    <option value="">Añade un dia</option>
                    <option value="lunes">Lunes</option>
                    <option value="martes">Martes</option>
                    <option value="miercoles">Miércoles</option>
                    <option value="jueves">Jueves</option>
                    <option value="viernes">Viernes</option>
                    <option value="sabado">Sábado</option>
                  </select>
    
                </div>
    
                <div class="form-group">
                  <div id="filaExistente" class="filaExistente">
                      <!-- Aquí se añadirán las columnas -->
                      @if($horariosExistente != null)
                        @foreach($horariosExistente as $dia => $horarios)
                            <div id="{{ strtolower($dia) }}" class="columna">
                                {{ ucfirst($dia) }}
                                <button type="button" onclick="abrirOtroModal('{{ strtolower($dia) }}')">Añadir</button>
                                <table>
                                    @foreach($horarios as $horario)
                                    <tr data-horario-id="{{ $horario->id }}"> <!-- Agregar data-horario-id con el ID del horario -->
                                        <td>{{ $horario->horaInicio }} -</td>
                                        <td>{{ $horario->horaFin }}</td>
                                        <td><button onclick="eliminarFila(this, {{ $horario->id }})" class="boton-eliminar">X</button></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endforeach
                      @endif
                      
                      
                      <!-- Div para almacenar los IDs de los horarios a borrar -->
                      <div name="borrar[]"></div>
                      

                  </div>
                </div>
                <div id="camposHorarios"></div>
                <div id="camposDiasSemana" name= "diaSemana[]"></div>
  
                
                <div class="botones">
                  <button type="button" class="btn-cancelar" onclick="CancelarReg()" style="text-decoration: none; color: f5f6f7;">Cancelar</button>
                </button>
  
                  <input type="hidden" name="id" value="{{ isset($ambienteDatos) ? $ambienteDatos->id : '' }}">
                  <button type="submit" class="btn-registrar" onclick="obtenerDatos2()">{{ isset($ambienteDatos) ? 'Actualizar' : 'Registrar' }}</button>
    
                </div>
                </form>
            </div>
             <!-- Modal Cancelar -->
        <div id="fondoGris"></div>
        <div class="panel" id="panelCancelar">
            <p>¿Esta seguro que desea cancelar el registro?</p>
            <div class="btnPanel">
                <button class= "no" onclick="noCancela()" >No</button>
                <button class="si" onclick="location.href='{{ route('AmbientesRegistrados') }}';">Si</button>
            </div>
        </div>
        </main>

         <!-- Modal Ambiente -->
         <div id="modalOtro" class="modal">
                  <div class="modal-contenido">
                      <span class="close" onclick="cerrarModal()">&times;</span>
                      <div class="nuevo-tipo">
                      <label for="otroAmbiente">Ingrese otro tipo de ambiente:</label>
                      <input type="text" id="otroAmbiente" name="otroAmbiente">
                      </div>
                      <button type="button" id="aceptarModal" onclick="agregarOtroAmbiente()">Aceptar</button> <!-- Cambiar el tipo de botón a "button" -->
                  </div>
              </div>
  
                <!-- Modal para AÑADIR HORA -->
                <div id="otroModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="cerrarOtroModal()">&times;</span>
            
                        <div class="horarios">
                        <label for="modalHoraInicio">Hora inicio:</label>
                        <input type="time" id="modalHoraInicio" name="modalHoraInicio" pattern="[0-9]{2}:[0-9]{2}">
                        <label for="modalHoraFin" >Hora fin:</label>
                        <input type="time" id="modalHoraFin" name="modalHoraFin"pattern="[0-9]{2}:[0-9]{2}">
                        </div>
                        
                        <button type="button" id="modalAceptar">Aceptar</button> <!-- Añade un id al botón -->
                        
                    </div>
                </div>
@endsection

@section('scripts')
     <!-- JavaScript  agregar hora -->
     <script>
      
      const diasSemana = {
        '1': [],
        '2': [],
        '3': [],
        '4': [],
        '5': [],
        '6': [],
        '7': [],
    };
    const nombresDias = {
    'lunes': 1,
    'martes': 2,
    'miercoles': 3,
    'jueves': 4,
    'viernes': 5,
    'sábado': 6,
    'domingo': 7
    };

    
    function agregarColumna() {
        var seleccion = document.getElementById("diasSemana").value;
        if (seleccion) {
            // Verificar si la columna ya existe
            if (!document.getElementById(seleccion)) {
                // Crear un nuevo elemento div para la columna
                var nuevaColumna = document.createElement("div");
                nuevaColumna.id = seleccion;
                nuevaColumna.className = "columna";
                nuevaColumna.textContent = seleccion.charAt(0).toUpperCase() + seleccion.slice(1); // Capitalizar el día
    
                // Crear un botón "Añadir" para la columna
                var botonAgregar = document.createElement("button");
                botonAgregar.textContent = "Añadir";
                botonAgregar.type = "button"; // Asegurarse de que el tipo de botón sea 'button' y no 'submit'
                botonAgregar.onclick = function() {
                    abrirOtroModal(seleccion);
                };
                nuevaColumna.appendChild(botonAgregar);
    
                // Crear una tabla para la columna
                var tabla = document.createElement("table");
                nuevaColumna.appendChild(tabla);
    
                // Añadir la nueva columna al final de la fila existente
                document.getElementById("filaExistente").appendChild(nuevaColumna);
            }
        }
    }
    
    function agregarFila(seleccion) {
        var horaInicio = document.getElementById("modalHoraInicio").value;
        var horaFin = document.getElementById("modalHoraFin").value;
        console.log(seleccion.toLowerCase());
        // Crea la fila solo si se han proporcionado horas de inicio y fin
        if (horaInicio.trim() !== "" && horaFin.trim() !== "") {
            var nuevaFila = document.createElement("tr");
            nuevaFila.innerHTML = '<td>' + horaInicio + ' -</td><td>' + horaFin + '</td><td><button onclick="eliminarFila(this)" class="boton-eliminar">X</button></td>';
            document.getElementById(seleccion).querySelector("table").appendChild(nuevaFila);

            const seleccionNumero = nombresDias[seleccion.toLowerCase()];
            console.log(seleccionNumero);
            diasSemana[seleccionNumero].push({ inicio: horaInicio, fin: horaFin }); // Guardar los datos en el formato deseado
            cerrarOtroModal();
        } else {
            alert("Por favor, ingrese la hora de inicio y fin.");
        }
    }
    
    function eliminarFila(boton, horarioId) {
      var fila = boton.parentNode.parentNode;
      var tabla = fila.parentNode;
  
      // Eliminar la fila de la tabla
      tabla.removeChild(fila);
  
      // Agregar el ID del horario al array "borrar[]"
      var borrarDiv = document.querySelector('[name="borrar[]"]');
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'borrar[]';
      input.value = horarioId;
      borrarDiv.appendChild(input);
  }
    
    function abrirOtroModal(seleccion) {
        document.getElementById("otroModal").style.display = "block";
        document.getElementById("modalHoraInicio").value = ""; // Limpiar valores de hora
        document.getElementById("modalHoraFin").value = "";
        document.getElementById("modalAceptar").onclick = function() {
            agregarFila(seleccion); // Pasar el día seleccionado al agregar la fila
        };
    }
    
    function cerrarOtroModal() {
        document.getElementById("otroModal").style.display = "none";
    }
    
    // Función para obtener los datos en el formato requerido
    /*function obtenerDatos() {
        console.log(diasSemana);
        convertirAFormatoHTML();
         // Inserta los campos generados en el div correspondiente
         document.getElementById("camposDiasSemana").innerHTML = convertirAFormatoHTML();
    }*/
    
    function convertirAFormatoHTML() {
                let formHTML = '';
                for (const dia in diasSemana) {
                    formHTML += `<input type="hidden" name="diaSemana[${dia}]" value='${JSON.stringify(diasSemana[dia])}'>\n`;
                }
                return formHTML;
            }
         
    </script>
    
   
    <!-- Horarios version 2-->
    <script>
      var horarioSeleccionado = {}; // Variable para almacenar los horarios seleccionados
    var diasHorarios = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
    var intervalos = [
        ["6:45", "8:15"],
        ["8:15", "9:45"],
        ["9:45", "11:15"],
        ["11:15", "12:45"],
        ["12:45", "14:15"],
        ["14:15", "15:45"],
        ["15:45", "17:15"],
        ["17:15", "18:45"],
        ["18:45", "20:15"],
        ["20:15", "21:45"]
    ];

    function crearHorario() {
        var horario = document.getElementById('horario');

        for (var i = 0; i < intervalos.length; i++) {
            var fila = document.createElement('tr');
            for (var j = 0; j < 6; j++) {
                var celda = document.createElement('td');
                if (j === 5 && i >= 6) { // Para sábado, solo mostrar hasta la sexta fila
                    break;
                }
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'horario_checkbox';
                checkbox.addEventListener('change', function (i, j) {
                    return function () {
                        handleCheckboxChange(i, j);
                    };
                }(i, j));
                celda.appendChild(checkbox);
                var horaInicio = intervalos[i][0];
                var horaFin = intervalos[i][1];
                celda.appendChild(document.createTextNode(' ' + horaInicio + ' - ' + horaFin));
                fila.appendChild(celda);
            }
            horario.appendChild(fila);
        }

        // Agregar botones "Seleccionar todos" y "Deseleccionar todos" al final de cada columna
        var columnas = horario.getElementsByTagName('th');
        for (var k = 0; k < columnas.length; k++) {
            var botonSeleccionarTodos = document.createElement('button');
            botonSeleccionarTodos.textContent = 'Seleccionar todos';
            botonSeleccionarTodos.type='button';
            botonSeleccionarTodos.onclick = (function(k) {
                return function() {
                    marcarTodos(k, true);
                };
            })(k);
            columnas[k].appendChild(botonSeleccionarTodos);
            
            var botonDeseleccionarTodos = document.createElement('button');
            botonDeseleccionarTodos.textContent = 'Deseleccionar todos';
            botonDeseleccionarTodos.type='button';
            botonDeseleccionarTodos.onclick = (function(k) {
                return function() {
                    if (haySeleccionados(k)) {
                        marcarTodos(k, false);
                    }
                };
            })(k);
            columnas[k].appendChild(botonDeseleccionarTodos);
        }
    }

    function handleCheckboxChange(i, j) {
        var dia = diasHorarios[j];
        if (!horarioSeleccionado[dia]) {
            horarioSeleccionado[dia] = [];
        }
        var horaInicio = intervalos[i][0];
        var horaFin = intervalos[i][1];
        var checkbox = document.getElementById('horario').getElementsByTagName('tr')[i + 1].getElementsByTagName('td')[j].getElementsByTagName('input')[0];
        if (checkbox.checked) {
            horarioSeleccionado[dia].push({ inicio: horaInicio, fin: horaFin });
        } else {
            var index = horarioSeleccionado[dia].findIndex(function (element) {
                return element.inicio === horaInicio && element.fin === horaFin;
            });
            if (index !== -1) {
                horarioSeleccionado[dia].splice(index, 1);
            }
        }
        console.log(horarioSeleccionado);
    }

    function marcarTodos(columna, estado) {
        var checkboxes = document.querySelectorAll('#horario tr td:nth-child(' + (columna + 1) + ') input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = estado;
            handleCheckboxChange(checkbox.parentNode.parentNode.rowIndex - 1, columna);
        });
    }

    function haySeleccionados(columna) {
        var checkboxes = document.querySelectorAll('#horario tr td:nth-child(' + (columna + 1) + ') input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                return true;
            }
        }
        return false;
    }

    /*function obtenerDatos2() {
        convertirAFormatoHTML();
         // Inserta los campos generados en el div correspondiente
         document.getElementById("camposHorarios").innerHTML = convertirAFormatoHTML2();
    }*/
    function obtenerDatos2() {
    const formHTML = convertirAFormatoHTML();
    const formHTML2 = convertirAFormatoHTML2();
    document.getElementById("camposDiasSemana").innerHTML = formHTML;
    document.getElementById("camposHorarios").innerHTML = formHTML2;
}


    function convertirAFormatoHTML2() {
        let formHTML2 = '';
        for (const dia2 in horarioSeleccionado) {
            formHTML2 += `<input type="hidden" name="horario[${dia2}]" value='${JSON.stringify(horarioSeleccionado[dia2])}'>\n`;
        }
        return formHTML2;
    }

    crearHorario();

    // Recuperar los horarios existentes y marcar los checkbox correspondientes
    function marcarCheckboxSegunDatos() {
        const horariosExistente = @json($horariosExistente);
        for (const dia in horariosExistente) {
            const indiceDia = diasHorarios.indexOf(dia);
            if (indiceDia !== -1) {
                horariosExistente[dia].forEach(horario => {
                    const indiceIntervalo = intervalos.findIndex(([inicio, fin]) => {
                        return inicio === horario.horaInicio && fin === horario.horaFin;
                    });
                    if (indiceIntervalo !== -1) {
                        const checkbox = document.getElementById('horario').getElementsByTagName('tr')[indiceIntervalo + 1].getElementsByTagName('td')[indiceDia].getElementsByTagName('input')[0];
                        checkbox.checked = true;
                        handleCheckboxChange(indiceIntervalo, indiceDia);
                    }
                });
            }
        }
    }

    // Llamar a la función para marcar los checkbox al cargar la página
    marcarCheckboxSegunDatos();

/*function crearHorario() {
  var horario = document.getElementById('horario');

  var diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
  var intervalos = [
    ["6:45", "8:15"],
    ["8:15", "9:45"],
    ["9:45", "11:15"],
    ["11:15", "12:45"],
    ["12:45", "14:15"],
    ["14:15", "15:45"],
    ["15:45", "17:15"],
    ["17:15", "18:45"],
    ["18:45", "20:15"],
    ["20:15", "21:45"]
  ];

  for (var i = 0; i < intervalos.length; i++) {
    var fila = document.createElement('tr');
    for (var j = 0; j < 6; j++) {
      var celda = document.createElement('td');
      if (j === 5 && i >= 6) { // Para sábado, solo mostrar hasta la sexta fila
        break;
      }
      var checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.name = 'horario_checkbox';
      celda.appendChild(checkbox);
      var horaInicio = intervalos[i][0];
      var horaFin = intervalos[i][1];
      celda.appendChild(document.createTextNode(' '+ horaInicio + ' - ' + horaFin));
      fila.appendChild(celda);
    }
    horario.appendChild(fila);
  }
  
  // Agregar botones "Todos" al final de cada columna
  var columnas = horario.getElementsByTagName('th');
  for (var k = 0; k < columnas.length; k++) {
    var botonTodos = document.createElement('button');
    botonTodos.textContent = 'Todos';
    botonTodos.type='button';
    if (k === 5) { // Para sábado
      botonTodos.onclick = marcarTodosSabado;
    } else { // Para lunes a viernes
      botonTodos.onclick = (function(k) {
        return function() {
          toggleMarcarTodosLunesAViernes(k);
        };
      })(k);
    }
    columnas[k].appendChild(botonTodos);
  }
}

function toggleMarcarTodosLunesAViernes(columna) {
  var checkboxes = document.querySelectorAll('#horario tr td:nth-child(' + (columna + 1) + ') input[type="checkbox"]');
  var todosMarcados = true;
  checkboxes.forEach(function(checkbox) {
    if (!checkbox.checked) {
      todosMarcados = false;
    }
  });
  checkboxes.forEach(function(checkbox) {
    checkbox.checked = !todosMarcados;
  });
}

function marcarTodosSabado() {
  var checkboxes = document.querySelectorAll('#horario tr td:nth-child(6) input[type="checkbox"]');
  var todosMarcados = true;
  checkboxes.forEach(function(checkbox) {
    if (!checkbox.checked) {
      todosMarcados = false;
    }
  });
  checkboxes.forEach(function(checkbox) {
    checkbox.checked = !todosMarcados;
  });
}

crearHorario();*/
</script>
   
   
   <!-- JavaScript  modal otro tipo ambiente -->
   <script>
      function abrirModal() {
          document.getElementById("modalOtro").style.display = "block";
      }
  
      function cerrarModal() {
          document.getElementById("modalOtro").style.display = "none";
      }
  
      document.addEventListener('DOMContentLoaded', function() {
        // Obtener el elemento select
        var select = document.getElementById('tipo-ambiente');

        // Llamar a la función verificarOtro con el valor seleccionado actualmente
        verificarOtro(select);
    });
      function verificarOtro(select) {
          var selectedOption = select.options[select.selectedIndex].value;
          if (selectedOption === "Otro") {
              abrirModal();
          } else {
              var optionOtro = select.querySelector('option[value="Otro"]');
              if (optionOtro) {
                  select.removeChild(optionOtro);
                  select.appendChild(optionOtro);
              }
          }
      }
  
      function agregarOtroAmbiente() {
      var otroAmbiente = document.getElementById("otroAmbiente").value;
      if (otroAmbiente.trim() !== "") {
          var select = document.getElementById("tipo-ambiente");
          // Verificar si la opción ya existe
          var optionExists = false;
          for (var i = 0; i < select.options.length; i++) {
              if (select.options[i].value === otroAmbiente) {
                  optionExists = true;
                  break;
              }
          }
          // Si la opción no existe, agregarla
          if (!optionExists) {
              var newOption = document.createElement("option");
              newOption.text = otroAmbiente;
              newOption.value = otroAmbiente;
              select.appendChild(newOption); // Agregar la nueva opción al menú desplegable
          }
          cerrarModal();
      } else {
          alert("Por favor, ingrese un tipo de ambiente.");
      }
  }
  </script>

  <script>
    function CancelarReg(){
    panelCancelar.style.display = 'block';
    fondoGris.style.display = 'flex';
    }

    function siCancela(){
        panelCancelar.style.display  = 'none';
        fondoGris.style.display = 'none';
    }
    function noCancela(){
        panelCancelar.style.display  = 'none';
        fondoGris.style.display = 'none';
    }
  </script>
@endsection