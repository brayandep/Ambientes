<section>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ambiente</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/registroAmbiente/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/script.js') }}">
  
  </head>
  <body>
      <main class="content-wrapper">
          <div class="container">
              <h2 style="padding-bottom:20px">Registro de Ambiente</h2>
              <form method="POST" action="{{ isset($ambienteDatos) ? route('registro.update', $ambienteDatos->id) : route('registro.store') }}">
                @csrf
                @if(isset($ambienteDatos))
                    @method('PUT')
                @endif

              <div class="form-group">
                  <label for="codigo">Código:</label>
                  <input type="text" id="codigo" name="codigo" style="width: 40%;" value="{{ isset($ambienteDatos) ? $ambienteDatos->codigo : '' }}">
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
                  <input type="text" id="nombre" name="nombre" style="width: 40%;" value="{{ isset($ambienteDatos) ? $ambienteDatos->nombre : '' }}">
                  <label for="capacidad">Capacidad:</label>
                  <input type="number" id="capacidad" name="capacidad" style="width: 40%;" value="{{ isset($ambienteDatos) ? $ambienteDatos->capacidad : '' }}">
              </div>
  
  
  
              <div class="form-group">
                  <label for="ubicacion">Ubicación:</label>
                  <input type="text" id="ubicacion" name="ubicacion" style="width: 40%;" value="{{ isset($ambienteDatos) ? $ambienteDatos->ubicacion : '' }}">
              
                <label for="tipo-ambiente">Tipo de ambiente:</label>
                <select id="tipo-ambiente" name="tipo-ambiente" style="width: 40%;" onchange="verificarOtro(this)">
                  <option value="">Selecciona una unidad</option>
                  @foreach($tipoAmbientes as $tipoAmbiente)
                    <option value="{{ $tipoAmbiente->nombreTipo}}" {{ isset($ambienteDatos) && $ambienteDatos->tipo_ambiente_id == $tipoAmbiente->id ? 'selected' : '' }}>{{ $tipoAmbiente->nombreTipo }}</option>
                  @endforeach
                    <option value="Otro">Otro</option> <!-- Opción adicional "Otro" -->
                </select>
            </div>
  


  


              <div class="form-grupo">
                  <label for="descripcion">Descripción de ubicación:</label>
                  <textarea id="descripcion" name="descripcion" >{{ isset($ambienteDatos) ? $ambienteDatos->descripcion_ubicacion : '' }}</textarea>
              </div>
              
              
              
              <div class="form-grupo">
                  <label>Equipos disponibles:</label><br>
                  <div class="checkbox-columns" style="padding-left: 20px;">
                      <div class="column">
                      <label><input type="checkbox" name="equipos-disponibles[]" value="Pizarra"> Pizarra</label><br>
                      <label><input type="checkbox" name="equipos-disponibles[]" value="Router"> Router</label><br>
                      </div>
                      <div class="column">
                      <label><input type="checkbox" name="equipos-disponibles[]" value="Data display"> Data display</label><br>
                      <label><input type="checkbox" name="equipos-disponibles[]" value="Microtiks"> Microtiks</label><br>
                      </div>
                      <div class="column">
                      <label><input type="checkbox" name="equipos-disponibles[]" value="Computadoras"> Computadoras</label><br>
                      </div>
                  </div>
                  </div>
  
              <div class="form-group">
                  <label for="diasSemana" style="width: 120px;">Horas hábiles:</label>
                  <select id="diasSemana" name= "diaSemana[]" onchange="agregarColumna()" style="width: 20%;">
  
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
                </div>
              </div>
  
              

              
              <div class="botones">
                <button class="btn-cancelar">
                  <a href="{{ route('registro.index') }}" style="text-decoration: none; color: inherit;">Cancelar</a>
              </button>

                <input type="hidden" name="id" value="{{ isset($ambienteDatos) ? $ambienteDatos->id : '' }}">
                <button type="submit" class="btn-registrar" >{{ isset($ambienteDatos) ? 'Actualizar' : 'Registrar' }}</button>
  
            </div>
              </form>
              
          </div>
       </main>
  </body>

  
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
  </html>


  

   <!-- JavaScript  agregar hora -->
<script>
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
          cerrarOtroModal();
      } else {
          alert("Por favor, ingrese la hora de inicio y fin.");
      }
  }

  function eliminarFila(boton) {
      boton.parentNode.parentNode.remove();
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

  </section>