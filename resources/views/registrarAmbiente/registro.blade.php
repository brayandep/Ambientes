@extends('layoutes.plantilla')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/registroAmbiente/stylesAmbiente.css') }}">
@endsection

@section('titulo', 'Registro de Ambiente')

@section('contenido')
<main class="content-wrapper">
            <div class="container">
            <h2 style="padding-bottom:20px" >{{ isset($ambienteDatos) ? 'Editar Ambiente' : 'Registro de Ambiente' }}</h2>
                <form method="POST" action="{{ isset($ambienteDatos) ? route('registro.update', $ambienteDatos->id) : route('registro.store') }}">
                  @csrf
                  @if(isset($ambienteDatos))
                      @method('PUT')
                  @endif
  
                <div class="form-group">
                    <label for="codigo">Código:</label>
                    <input type="text" id="codigo" name="codigo" style="width: 40%;" required maxlength="10" autocomplete="off" placeholder="Ingrese codigo de ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->codigo : '' }}">
                    @error('codigo')
                        <span>*{{$message}}</span>
                    @enderror
                    <label for="unidad">Unidad:</label>
                        <select id="unidad" name="unidad" style="width: 40%;">
                        <option value="">Selecciona una unidad</option>
                        @foreach($unidades as $unidad)
                          <option value="{{ $unidad->nombreUnidad }}" {{ isset($ambienteDatos) && $ambienteDatos->unidad == $unidad->nombreUnidad ? 'selected' : '' }}>{{ $unidad->nombreUnidad }}</option>
                        @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" style="width: 40%;" required maxlength="25" autocomplete="off" placeholder="Ingrese nombre del ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->nombre : '' }}">
                    @error('nombre')
                        <span>*{{$message}}</span>
                    @enderror
                    <label for="capacidad">Capacidad:</label>
                    <input type="number" id="capacidad" name="capacidad" style="width: 40%;" required maxlength="3" autocomplete="off" placeholder="Ingrese capacidad de ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->capacidad : '' }}">
                    @error('capacidad')
                        <span>*{{$message}}</span>
                    @enderror
                  </div>
    
    
    
                <div class="form-group">
                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" style="width: 40%;" required maxlength="80" autocomplete="off" placeholder="Ingrese ubicacion URL del ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->ubicacion : '' }}">
                    @error('ubicacion')
                        <span>*{{$message}}</span>
                    @enderror
                  <label for="tipo-ambiente">Tipo de ambiente:</label>
                  <select id="tipo-ambiente" name="tipo-ambiente" style="width: 40%;" onchange="verificarOtro(this)">
                    <option>Selecciona una unidad</option>
                    @foreach($tipoAmbientes as $tipoAmbiente)
                      <option value="{{ $tipoAmbiente->nombreTipo}}" {{ isset($ambienteDatos) && $ambienteDatos->tipo_ambiente_id == $tipoAmbiente->id ? 'selected' : '' }}>{{ $tipoAmbiente->nombreTipo }}</option>
                    @endforeach
                      <option value="Otro">Otro</option> <!-- Opción adicional "Otro" -->
                  </select>
              </div>
    
  
  
    
  
  
                <div class="form-grupo">
                    <label for="descripcion">Descripción de ubicación:</label>
                    <textarea id="descripcion" name="descripcion" required maxlength="150" autocomplete="off">{{ isset($ambienteDatos) ? $ambienteDatos->descripcion_ubicacion : '' }}</textarea>
                    @error('descripcion')
                        <span>*{{$message}}</span>
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
                    <select id="diasSemana" onchange="agregarColumna()" style="width: 20%;">
    
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
    
                <div id="camposDiasSemana" name= "diaSemana[]"></div>
  
                
                <div class="botones">
                  <button class="btn-cancelar">
                    <a href="{{ route('AmbientesRegistrados') }}" style="text-decoration: none; color: inherit;">Cancelar</a>
                </button>
  
                  <input type="hidden" name="id" value="{{ isset($ambienteDatos) ? $ambienteDatos->id : '' }}">
                  <button type="submit" class="btn-registrar" onclick="obtenerDatos()">{{ isset($ambienteDatos) ? 'Actualizar' : 'Registrar' }}</button>
    
              </div>
                </form>
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
                        <label for="modalHoraFin" style="margin-left:30px">Hora fin:</label>
                        <input type="time" id="modalHoraFin" name="modalHoraFin" style="margin-right:50px" pattern="[0-9]{2}:[0-9]{2}">
                        </div>
                        
                        <button type="button" id="modalAceptar">Aceptar</button> <!-- Añade un id al botón -->
                        
                    </div>
                </div>
@endsection

@section('scripts')
     <!-- JavaScript  agregar hora -->
     <script>
      
      const diasSemana = {
        'lunes': [],
        'martes': [],
        'miercoles': [],
        'jueves': [],
        'viernes': [],
        'sabado': [],
        'domingo': [],
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
    
        // Crea la fila solo si se han proporcionado horas de inicio y fin
        if (horaInicio.trim() !== "" && horaFin.trim() !== "") {
            var nuevaFila = document.createElement("tr");
            nuevaFila.innerHTML = '<td>' + horaInicio + ' -</td><td>' + horaFin + '</td><td><button onclick="eliminarFila(this)" class="boton-eliminar">X</button></td>';
            document.getElementById(seleccion).querySelector("table").appendChild(nuevaFila);
            diasSemana[seleccion.toLowerCase()].push({ inicio: horaInicio, fin: horaFin }); // Guardar los datos en el formato deseado
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
    function obtenerDatos() {
        console.log(diasSemana);
        convertirAFormatoHTML();
         // Inserta los campos generados en el div correspondiente
         document.getElementById("camposDiasSemana").innerHTML = convertirAFormatoHTML();
    }
    
    function convertirAFormatoHTML() {
                let formHTML = '';
                for (const dia in diasSemana) {
                    formHTML += `<input type="hidden" name="diaSemana[${dia}]" value='${JSON.stringify(diasSemana[dia])}'>\n`;
                }
                return formHTML;
            }
         
    </script>
    
   
   
   
   <!-- JavaScript  modal otro tipo ambiente -->
   <script>
      function abrirModal() {
          document.getElementById("modalOtro").style.display = "block";
      }
  
      function cerrarModal() {
          document.getElementById("modalOtro").style.display = "none";
      }
  
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
@endsection