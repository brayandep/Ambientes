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
                    <input type="text" id="codigo" name="codigo" style="width: 40%;" required maxlength="10" autocomplete="off" placeholder="Ingrese codigo de ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->codigo : '' }}">
                    @error('codigo')
                        <span>*{{$message}}</span>
                    @enderror
                    <label for="unidad">Unidad:</label>
                        <select class="selectAmbiente" id="unidad" name="unidad" style="width: 40%;">
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
                  <select class="selectAmbiente" id="tipo-ambiente" name="tipo-ambiente" style="width: 40%;" onchange="verificarOtro(this); verificarOtroAmbiente(this)">
                    <option>Selecciona un tipo de ambiente</option>
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
    
                <div class="form-grupo">
                    <label style="width: 120px;">Horas hábiles:</label>
                    <table class="pizarra1">
                    <thead class="fila">
                        <tr>
                            <th><button type="button" class="nomCol" onclick="abrirModalHora('Lunes')">Lunes</button></th>
                            <th><button type="button" class="nomCol" onclick="abrirModalHora('Martes')">Martes</button></th>
                            <th><button type="button" class="nomCol" onclick="abrirModalHora('Miércoles')">Miércoles</button></th>
                            <th><button type="button" class="nomCol" onclick="abrirModalHora('Jueves')">Jueves</button></th>
                            <th><button type="button" class="nomCol" onclick="abrirModalHora('Viernes')">Viernes</button></th>
                            <th><button type="button" class="nomCol" onclick="abrirModalHora('Sabado')">Sábado</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="Lunes"></td>
                            <td id="Martes"></td>
                            <td id="Miércoles"></td>
                            <td id="Jueves"></td>
                            <td id="Viernes"></td>
                            <td id="Sabado"></td>
                        </tr>
                    </tbody>
                    </table>


                    <!--Version larga de los horarios-->
                    <table class="pizarra2">
                    <thead class="fila">
                        <tr>
                            <th><button type="button" class="nomColu">Lunes</button></th>
                            <th><button type="button" class="nomColu">Martes</button></th>
                            <th><button type="button" class="nomColu">Miércoles</button></th>
                            <th><button type="button" class="nomColu">Jueves</button></th>
                            <th><button type="button" class="nomColu">Viernes</button></th>
                            <th><button type="button" class="nomColu">Sábado</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td id="Lunes">
                            <!-- Checkbox para marcar todos los horarios del Lunes -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="marcarTodos" onclick="marcarTodos(this, 'lunes')">
                                <label>Marcar Todos</label>
                                <br>
                            </div>
                            
                            <!-- Horarios para el Lunes -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="06:45 - 08:15" id="horario1">
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="08:15 - 09:45" id="horario2">
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="09:45 - 11:15" id="horario3">
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="11:15 - 12:45" id="horario4">
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="12:45 - 14:15" id="horario5">
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="14:15 - 15:45" id="horario6">
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="15:45 - 17:15" id="horario7">
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="17:15 - 18:45" id="horario8">
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="18:45 - 20:15" id="horario9">
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" value="20:15 - 21:45" id="horario10">
                                <label for="horario10">20:15 - 21:45</label>
                            </div>
                        </td>

                        <td id="Martes">
                            <!-- Checkbox para marcar todos los horarios del Martes -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="marcarTodos" onclick="marcarTodos(this, 'martes')">
                                <label>Marcar Todos</label>
                                <br>
                            </div>
                            
                            <!-- Horarios para el Martes -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="06:45 - 08:15" id="horario1">
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="08:15 - 09:45" id="horario2">
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="09:45 - 11:15" id="horario3">
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="11:15 - 12:45" id="horario4">
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="12:45 - 14:15" id="horario5">
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="14:15 - 15:45" id="horario6">
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="15:45 - 17:15" id="horario7">
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="17:15 - 18:45" id="horario8">
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="18:45 - 20:15" id="horario9">
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" value="20:15 - 21:45" id="horario10">
                                <label for="horario10">20:15 - 21:45</label>
                            </div>
                        </td>

                        <td id="Miercoles">
                            <!-- Checkbox para marcar todos los horarios del Miércoles -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="marcarTodos" onclick="marcarTodos(this, 'miercoles')">
                                <label>Marcar Todos</label>
                                <br>
                            </div>
                            
                            <!-- Horarios para el Miércoles -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="06:45 - 08:15" id="horario1">
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="08:15 - 09:45" id="horario2">
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="09:45 - 11:15" id="horario3">
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="11:15 - 12:45" id="horario4">
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="12:45 - 14:15" id="horario5">
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="14:15 - 15:45" id="horario6">
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="15:45 - 17:15" id="horario7">
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="17:15 - 18:45" id="horario8">
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="18:45 - 20:15" id="horario9">
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-miercoles" value="20:15 - 21:45" id="horario10">
                                <label for="horario10">20:15 - 21:45</label>
                            </div>
                        </td>

                        <td id="Jueves">
                            <!-- Checkbox para marcar todos los horarios del Jueves -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="marcarTodos" onclick="marcarTodos(this, 'jueves')">
                                <label>Marcar Todos</label>
                                <br>
                            </div>
                            
                            <!-- Horarios para el Jueves -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="06:45 - 08:15" id="horario1">
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="08:15 - 09:45" id="horario2">
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="09:45 - 11:15" id="horario3">
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="11:15 - 12:45" id="horario4">
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="12:45 - 14:15" id="horario5">
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="14:15 - 15:45" id="horario6">
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="15:45 - 17:15" id="horario7">
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="17:15 - 18:45" id="horario8">
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="18:45 - 20:15" id="horario9">
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" value="20:15 - 21:45" id="horario10">
                                <label for="horario10">20:15 - 21:45</label>
                            </div>
                        </td>

                        <td id="Viernes">
                            <!-- Checkbox para marcar todos los horarios del Viernes -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="marcarTodos" onclick="marcarTodos(this, 'viernes')">
                                <label>Marcar Todos</label>
                                <br>
                            </div>
                            
                            <!-- Horarios para el Viernes -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="06:45 - 08:15" id="horario1">
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="08:15 - 09:45" id="horario2">
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="09:45 - 11:15" id="horario3">
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="11:15 - 12:45" id="horario4">
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="12:45 - 14:15" id="horario5">
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="14:15 - 15:45" id="horario6">
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="15:45 - 17:15" id="horario7">
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="17:15 - 18:45" id="horario8">
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="18:45 - 20:15" id="horario9">
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" value="20:15 - 21:45" id="horario10">
                                <label for="horario10">20:15 - 21:45</label>
                            </div>
                        </td>

                        <td class="estiloSab" id="Sabado">
                            <!-- Checkbox para marcar todos los horarios del Sábado -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="marcarTodos" onclick="marcarTodos(this, 'sabado')">
                                <label>Marcar Todos</label>
                                <br>
                            </div>
                            
                            <!-- Horarios para el Sábado -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-sabado" value="06:45 - 08:15" id="horario1">
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-sabado" value="08:15 - 09:45" id="horario2">
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-sabado" value="09:45 - 11:15" id="horario3">
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-sabado" value="11:15 - 12:45" id="horario4">
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-sabado" value="12:45 - 14:15" id="horario5">
                                <label for="horario5">12:45 - 14:15</label>
                            </div>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                
                <div class="botones">
                  <button type="button" class="btn-cancelar">
                    <a href="{{ route('AmbientesRegistrados') }}" style="text-decoration: none; color: inherit;">Cancelar</a>
                </button>
  
                  <input type="hidden" name="id" value="{{ isset($ambienteDatos) ? $ambienteDatos->id : '' }}">
                  <button type="submit" class="btn-registrar" onclick="obtenerDatos2()">{{ isset($ambienteDatos) ? 'Actualizar' : 'Registrar' }}</button>
    
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
                        <h2>Seleccione el horario:</h2> <!-- Título del modal /////////////////////////////////-->
                        <div class="horarios">
                            <label for="modalHoraInicio">Hora inicio:</label>
                            <select id="modalHoraInicio">
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                            </select>
                            <label style="padding-left: 30px;" for="modalHoraFin">Hora fin:</label>
                            <select id="modalHoraFin">
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                            </select>
                        </div>
                        <span id="errorMensaje" style="color: red;"></span> <!-- Mensaje de error -->
                        <button type="button" id="modalAceptar" onclick="guardarHorario()">Aceptar</button>
                    </div>
                </div>
@endsection

@section('scripts')
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
        verificarOtroAmbiente(select);
    });
      function verificarOtroAmbiente(select) {
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

<script> //////// SCRIP PARA EL MODAL DE HORARIO VERSION CORTA
    function abrirModalHora(dia) {
        // Mostrar el modal
        document.getElementById('otroModal').style.display = 'block';
        
        // Configurar el título del modal
        document.querySelector('.horarios').setAttribute('data-dia', dia);
    }

    function cerrarOtroModal() {
        // Reiniciar los valores de los campos de entrada del modal
        document.getElementById('modalHoraInicio').value = '';
        document.getElementById('modalHoraFin').value = '';
        
        // Cerrar el modal
        document.getElementById('otroModal').style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function() {
    // Agregar evento change a los select de hora
    var horaInicioSelect = document.getElementById('modalHoraInicio');
    var horaFinSelect = document.getElementById('modalHoraFin');
    
    horaInicioSelect.addEventListener('change', limpiarError);
    horaFinSelect.addEventListener('change', limpiarError);
});

function limpiarError() {
    var errorMensaje = document.getElementById('errorMensaje');
    errorMensaje.innerText = ""; // Limpiar el mensaje de error
}

function guardarHorario() {
    // Obtener los valores de las horas
    var horaInicio = document.getElementById('modalHoraInicio').value;
    var horaFin = document.getElementById('modalHoraFin').value;
    
    // Convertir las horas a números enteros para comparar
    var inicio = parseInt(horaInicio.replace(":", ""));
    var fin = parseInt(horaFin.replace(":", ""));
    
    // Obtener el elemento para el mensaje de error
    var errorMensaje = document.getElementById('errorMensaje');
    
    // Validar que la hora de fin sea mayor que la hora de inicio
    if (fin <= inicio) {
        errorMensaje.innerText = "La hora de fin debe ser mayor que la hora de inicio.";
        return; // Detener la ejecución de la función si la validación falla
    } else {
        errorMensaje.innerText = ""; // Limpiar el mensaje de error si la validación es exitosa
    }
    
    // Obtener el día del modal
    var dia = document.querySelector('.horarios').getAttribute('data-dia');
    
    // Actualizar la celda correspondiente con el intervalo de horas
    document.getElementById(dia).innerText = horaInicio + ' - ' + horaFin;
    
    // Cerrar el modal
    cerrarOtroModal();
}



</script>

<script>
    function marcarTodos(checkbox, dia) {
        // Obtener todos los checkboxes del día especificado
        var checkboxes = document.querySelectorAll('.checkbox-' + dia);
        
        // Marcar o desmarcar todos los checkboxes según el estado del checkbox "Marcar Todos"
        checkboxes.forEach(function(cb) {
            cb.checked = checkbox.checked;
        });
    }
</script>

<script>
    function verificarOtro(selectElement) {
        var tipoAmbiente = selectElement.value;
        var pizarra1 = document.querySelector('.pizarra1');
        var pizarra2 = document.querySelector('.pizarra2');

        // Ocultar ambas tablas inicialmente
        pizarra1.style.display = 'none';
        pizarra2.style.display = 'none';

        // Mostrar la tabla correspondiente según el tipo de ambiente seleccionado
        if (tipoAmbiente === 'Auditorio') {
            pizarra1.style.display = 'block';
        } else {
            pizarra2.style.display = 'block';
        }
    }
</script>
@endsection