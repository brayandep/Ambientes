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
            <form action="#">
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" id="codigo" name="codigo" style="width: 40%;">
                <label for="unidad">Unidad:</label>
                    <select id="unidad" name="unidad" style="width: 40%;">
                    <option value="">Selecciona una unidad</option>
                    <option value="Dep-Matematicas">Dep. Matematicas</option>
                    <option value="Dep-Sistemas">Dep. Sistemas</option>
                    <option value="Dep-Informatica">Dep. Informatica</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" style="width: 40%;">
                <label for="capacidad">Capacidad:</label>
                <input type="number" id="capacidad" name="capacidad" style="width: 40%;">
            </div>

            
            <div class="form-group">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" style="width: 40%;">
            
                <label for="tipo-ambiente">Tipo de ambiente:</label>
                <select id="tipo-ambiente" name="tipo-ambiente" style="width: 40%;">
                <option value="">Selecciona un tipo de ambiente</option>
                <option value="Aula común">Aula común</option>
                <option value="Auditorio">Auditorio</option>
                <option value="Laboratorio">Laboratorio</option>
                </select>
            </div>


            <div class="form-grupo">
                <label for="descripcion">Descripción de ubicación:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </div>
            
            
            
            <div class="form-grupo">
                <label>Equipos disponibles:</label><br>
                <div class="checkbox-columns" style="padding-left: 20px;">
                    <div class="column">
                    <label><input type="checkbox" name="equipos-disponibles" value="Pizarra"> Pizarra</label><br>
                    <label><input type="checkbox" name="equipos-disponibles" value="Router"> Router</label><br>
                    </div>
                    <div class="column">
                    <label><input type="checkbox" name="equipos-disponibles" value="Data display"> Data display</label><br>
                    <label><input type="checkbox" name="equipos-disponibles" value="Microtiks"> Microtiks</label><br>
                    </div>
                    <div class="column">
                    <label><input type="checkbox" name="equipos-disponibles" value="Computadoras"> Computadoras</label><br>
                    </div>
                </div>
                </div>

            <div class="form-group">
                <label for="diasSemana" style="width: 200px;">Horas hábiles:</label>
                <select id="diasSemana" onchange="agregarColumna()" style="width: 20%;">

                <!--<select id="diasSemana" onchange="agregarColumna()">-->
                <option value="">Añade un dia</option>
                <option value="lunes">Lunes</option>
                <option value="martes">Martes</option>
                <option value="miercoles">Miércoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
                <option value="sabado">Sábado</option>
              </select>

            </div>

              <div class="form-group" id="filaExistente">
                <!-- Aquí se añadirán las columnas -->
              </div>

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

                  // Añadir la nueva columna al final de la fila existente
                  document.getElementById("filaExistente").appendChild(nuevaColumna);

                  // Crear un botón "Añadir" para la columna
                  var botonAgregar = document.createElement("button");
                  botonAgregar.textContent = "Añadir";
                  botonAgregar.onclick = function() {
                    agregarFila(seleccion);
                  };
                  nuevaColumna.appendChild(botonAgregar);
                }
              }
            }

            function agregarFila(columna) {
              // Solicitar las horas de inicio y fin
              var horaInicio = prompt("Ingrese la hora de inicio (formato HH:MM)");
              var horaFin = prompt("Ingrese la hora de fin (formato HH:MM)");

              // Crear un nuevo elemento div para la fila
              var nuevaFila = document.createElement("div");

              // Crear elementos para mostrar las horas
              var horaInicioElemento = document.createElement("span");
              horaInicioElemento.textContent = horaInicio + "-";
              var horaFinElemento = document.createElement("span");
              horaFinElemento.textContent = horaFin;

              // Crear un botón "Eliminar" para la fila
              var botonEliminar = document.createElement("button");
              botonEliminar.textContent = "X";
              botonEliminar.onclick = function() {
                eliminarFila(this);
              };
              botonEliminar.classList.add("boton-eliminar");

              // Añadir los elementos a la fila
              nuevaFila.appendChild(horaInicioElemento);
              nuevaFila.appendChild(horaFinElemento);
              nuevaFila.appendChild(botonEliminar);

              // Añadir la nueva fila a la columna correspondiente
              document.getElementById(columna).appendChild(nuevaFila);
            }

            function eliminarFila(boton) {
              // Obtener el padre del botón (la fila) y eliminarlo
              boton.parentNode.remove();
            }
          </script>
            
            <div class="botones">
                <button type="submit" class="btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-registrar">Registrar</button>
            </div>
            </form>
            
        </div>
     </main>
</body>
</html>
</section>