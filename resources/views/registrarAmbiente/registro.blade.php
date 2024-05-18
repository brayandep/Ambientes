@extends('layoutes.plantilla')

@section('links')
    <link rel="stylesheet" type="text/css" href="../../css/registroAmbiente/stylesAmbiente.css">
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
  
                <div class="form-fila-s">
                    <div class="input-group">
                    <label for="codigo">Código:</label>
                    <input type="text" id="codigo" name="codigo" maxlength="5" autocomplete="off" placeholder="Ingrese codigo de ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->codigo : '' }}">
                    @error('codigo')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                    </div>
                    <div class="input-group">
                    <label for="unidad">Unidad:</label>
                        <select class="selectAmbiente" id="unidad" name="unidad">
                        <option value="">Selecciona una unidad</option>
                        @foreach($unidades as $unidad)
                          <option value="{{ $unidad->nombreUnidad }}" {{ isset($ambienteDatos) && $ambienteDatos->unidad == $unidad->nombreUnidad ? 'selected' : '' }}>{{ $unidad->nombreUnidad }}</option>
                        @endforeach
                        </select>
                        @error('unidad')
                            <span class="msgError">*{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-fila-s">
                    <div class="input-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" maxlength="25" autocomplete="off" placeholder="Ingrese nombre del ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->nombre : '' }}">
                    @error('nombre')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                    </div>
                    <div class="input-group">
                    <label for="capacidad">Capacidad:</label>
                    <input type="number" id="capacidad" name="capacidad"  maxlength="3" autocomplete="off" placeholder="Ingrese capacidad de ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->capacidad : '' }}">
                    @error('capacidad')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                    </div>
                </div>
    
    
    
                <div class="form-fila-s">
                    <div class="input-group">
                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" maxlength="80" autocomplete="off" placeholder="Ingrese URL: https://www.google.com/maps/ del ambiente" value="{{ isset($ambienteDatos) ? $ambienteDatos->ubicacion : '' }}">
                    @error('ubicacion')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                    </div>
                    <div class="input-group">
                  <label for="tipo-ambiente">Tipo de ambiente:</label>
                  <select class="selectAmbiente" id="tipo-ambiente" name="tipo-ambiente" onchange="verificarOtroAmbiente(this);verificarOtro(this)">
                    <option value="">Selecciona un tipo de ambiente</option>
                    @foreach($tipoAmbientes as $tipoAmbiente)
                      <option value="{{ $tipoAmbiente->nombreTipo}}" {{ isset($ambienteDatos) && $ambienteDatos->tipo_ambiente_id == $tipoAmbiente->id ? 'selected' : '' }}>{{ $tipoAmbiente->nombreTipo }}</option>
                    @endforeach
                      <option value="Otro">Otro</option> <!-- Opción adicional "Otro" -->
                  </select>
                    @error('tipo-ambiente')
                        <span class="msgError">*{{$message}}</span>
                    @enderror
                    </div>
              </div>
    

  
                <div class="form-grupo">
                    <label for="descripcion">Descripción de ubicación:</label>
                    <textarea id="descripcion" name="descripcion" maxlength="40" autocomplete="off">{{ isset($ambienteDatos) ? $ambienteDatos->descripcion_ubicacion : '' }}</textarea>
                    @error('descripcion')
                        <span class="msgError">*{{$message}}</span>
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
                            <th><button type="button" class="nomCol" onclick="abrirModalHora('Sábado')">Sábado</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="Lunes"></td>
                            <td id="Martes"></td>
                            <td id="Miércoles"></td>
                            <td id="Jueves"></td>
                            <td id="Viernes"></td>
                            <td id="Sábado"></td>
                            
                        </tr>
                        <ul id="listaHorarios">
                            <!-- Los horarios se añadirán aquí dinámicamente -->
                        </ul>
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
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 06:45 08:15" id="horario1" {{ in_array('Lunes 06:45 08:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 08:15 09:45" id="horario2" {{ in_array('Lunes 08:15 09:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 09:45 11:15" id="horario3"{{ in_array('Lunes 09:45 11:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 11:15 12:45" id="horario4"{{ in_array('Lunes 11:15 12:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 12:45 14:15" id="horario5"{{ in_array('Lunes 12:45 14:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 14:15 15:45" id="horario6"{{ in_array('Lunes 14:15 15:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 15:45 17:15" id="horario7"{{ in_array('Lunes 15:45 17:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 17:15 18:45" id="horario8"{{ in_array('Lunes 17:15 18:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 18:45 20:15" id="horario9"{{ in_array('Lunes 18:45 20:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-lunes" name="horarios[]" value="Lunes 20:15 21:45" id="horario10"{{ in_array('Lunes 20:15 21:45', $horariosDisponibles) ? 'checked' : '' }}>
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
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 06:45 08:15" id="horario1"{{ in_array('Martes 06:45 08:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 08:15 09:45" id="horario2"{{ in_array('Martes 08:15 09:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 09:45 11:15" id="horario3"{{ in_array('Martes 09:45 11:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 11:15 12:45" id="horario4"{{ in_array('Martes 11:15 12:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 12:45 14:15" id="horario5"{{ in_array('Martes 12:45 14:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 14:15 15:45" id="horario6"{{ in_array('Martes 14:15 15:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 15:45 17:15" id="horario7"{{ in_array('Martes 15:45 17:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 17:15 18:45" id="horario8"{{ in_array('Martes 17:15 18:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 18:45 20:15" id="horario9"{{ in_array('Martes 18:45 20:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-martes" name="horarios[]" value="Martes 20:15 21:45" id="horario10"{{ in_array('Martes 20:15 21:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario10">20:15 - 21:45</label>
                            </div>
                        </td>

                        <td id="Miércoles">
                            <!-- Checkbox para marcar todos los horarios del Miércoles -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="marcarTodos" onclick="marcarTodos(this, 'Miércoles')">
                                <label>Marcar Todos</label>
                                <br>
                            </div>
                            
                            <!-- Horarios para el Miércoles -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 06:45 08:15" id="horario1" {{ in_array('Miércoles 06:45 08:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 08:15 09:45" id="horario2" {{ in_array('Miércoles 08:15 09:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 09:45 11:15" id="horario3" {{ in_array('Miércoles 09:45 11:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 11:15 12:45" id="horario4" {{ in_array('Miércoles 11:15 12:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 12:45 14:15" id="horario5" {{ in_array('Miércoles 12:45 14:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 14:15 15:45" id="horario6" {{ in_array('Miércoles 14:15 15:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 15:45 17:15" id="horario7" {{ in_array('Miércoles 15:45 17:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 17:15 18:45" id="horario8" {{ in_array('Miércoles 17:15 18:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 18:45 20:15" id="horario9" {{ in_array('Miércoles 18:45 20:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Miércoles" name="horarios[]" value="Miércoles 20:15 21:45" id="horario10" {{ in_array('Miércoles 20:15 21:45', $horariosDisponibles) ? 'checked' : '' }}>
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
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 06:45 08:15" id="horario1" {{ in_array('Jueves 06:45 08:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 08:15 09:45" id="horario2" {{ in_array('Jueves 08:15 09:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 09:45 11:15" id="horario3" {{ in_array('Jueves 09:45 11:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 11:15 12:45" id="horario4" {{ in_array('Jueves 11:15 12:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 12:45 14:15" id="horario5" {{ in_array('Jueves 12:45 14:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 14:15 15:45" id="horario6" {{ in_array('Jueves 14:15 15:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 15:45 17:15" id="horario7" {{ in_array('Jueves 15:45 17:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 17:15 18:45" id="horario8" {{ in_array('Jueves 17:15 18:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 18:45 20:15" id="horario9" {{ in_array('Jueves 18:45 20:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-jueves" name="horarios[]" value="Jueves 20:15 21:45" id="horario10" {{ in_array('Jueves 20:15 21:45', $horariosDisponibles) ? 'checked' : '' }}>
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
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 06:45 08:15" id="horario1" {{ in_array('Viernes 06:45 08:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 08:15 09:45" id="horario2" {{ in_array('Viernes 08:15 09:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 09:45 11:15" id="horario3" {{ in_array('Viernes 09:45 11:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 11:15 12:45" id="horario4" {{ in_array('Viernes 11:15 12:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 12:45 14:15" id="horario5" {{ in_array('Viernes 12:45 14:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario5">12:45 - 14:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 14:15 15:45" id="horario6" {{ in_array('Viernes 14:15 15:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario6">14:15 - 15:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 15:45 17:15" id="horario7" {{ in_array('Viernes 15:45 17:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario7">15:45 - 17:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 17:15 18:45" id="horario8" {{ in_array('Viernes 17:15 18:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario8">17:15 - 18:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 18:45 20:15" id="horario9" {{ in_array('Viernes 18:45 20:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario9">18:45 - 20:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-viernes" name="horarios[]" value="Viernes 20:15 21:45" id="horario10" {{ in_array('Viernes 20:15 21:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario10">20:15 - 21:45</label>
                            </div>
                        </td>

                        <td class="estiloSab" id="Sábado">
                            <!-- Checkbox para marcar todos los horarios del Sábado -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="marcarTodos" onclick="marcarTodos(this, 'Sábado')">
                                <label>Marcar Todos</label>
                                <br>
                            </div>
                            
                            <!-- Horarios para el Sábado -->
                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Sábado" name="horarios[]" value="Sábado 06:45 08:15" id="horario1" {{ in_array('Sábado 06:45 08:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario1">06:45 - 08:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Sábado" name="horarios[]" value="Sábado 08:15 09:45" id="horario2" {{ in_array('Sábado 08:15 09:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario2">08:15 - 09:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Sábado" name="horarios[]" value="Sábado 09:45 11:15" id="horario3" {{ in_array('Sábado 09:45 11:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario3">09:45 - 11:15</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Sábado" name="horarios[]" value="Sábado 11:15 12:45" id="horario4" {{ in_array('Sábado 11:15 12:45', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario4">11:15 - 12:45</label>
                            </div>

                            <div class="checkbox-container">
                                <input type="checkbox" class="checkbox-Sábado" name="horarios[]" value="Sábado 12:45 14:15" id="horario5" {{ in_array('Sábado 12:45 14:15', $horariosDisponibles) ? 'checked' : '' }}>
                                <label for="horario5">12:45 - 14:15</label>
                            </div>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                
                <div class="botones">
                  <button type="button" onclick="CancelarReg()" class="btn-cancelar">Cancelar
                    {{-- <a href="{{ route('AmbientesRegistrados') }}" style="text-decoration: none; color: inherit;">Cancelar</a> --}}
                </button>
  
                  <input type="hidden" name="id" value="{{ isset($ambienteDatos) ? $ambienteDatos->id : '' }}">
                  <button type="submit" class="btn-registrar" onclick="obtenerDatos2()">{{ isset($ambienteDatos) ? 'Actualizar' : 'Registrar' }}</button>
    
              </div>
                </form>
                <div id="fondoGris"></div>
                <div class="panel" id="panelCancelar">
                    <p>¿Esta seguro que desea cancelar el registro?</p>
                    <div class="btnPanel">
                        <button class= "no" onclick="noCancela()" >No</button>
                        <button class="si" onclick="location.href='{{ route('AmbientesRegistrados') }}';">Si</button>
                    </div>
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
                        <h2>Seleccione el horario:</h2> <!-- Título del modal-->
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
<script>

    var horarios2 = @json($horariosDisponibles2);
    var horarios3 = @json($horariosDisponibles2);

    console.log(horarios2);

    function mostrarHorarios() {
    // Limpiar las celdas existentes
    document.getElementById('Lunes').innerHTML = '';
    document.getElementById('Martes').innerHTML = '';
    document.getElementById('Miércoles').innerHTML = '';
    document.getElementById('Jueves').innerHTML = '';
    document.getElementById('Viernes').innerHTML = '';
    document.getElementById('Sábado').innerHTML = '';

    // Iterar sobre cada horario y añadirlo al día correspondiente
    horarios2.forEach(function(horario) {
        var parts = horario.split(' ');
        var dia = parts[0]; // El día es la primera parte
        var horaInicio = parts[1]; // La hora de inicio es la segunda parte
        var horaFin = parts[2]; // La hora de fin es la tercera parte

        // Formatear el horario como un elemento li para mayor coherencia
        var horarioFormatted = document.createElement('div');
        horarioFormatted.textContent = horaInicio + ' - ' + horaFin;

        // Identificar el día correcto y añadir el horario
        switch (dia) {
            case 'Lunes':
                document.getElementById('Lunes').appendChild(horarioFormatted);
                break;
            case 'Martes':
                document.getElementById('Martes').appendChild(horarioFormatted);
                break;
            case 'Miércoles':
                document.getElementById('Miércoles').appendChild(horarioFormatted);
                break;
            case 'Jueves':
                document.getElementById('Jueves').appendChild(horarioFormatted);
                break;
            case 'Viernes':
                document.getElementById('Viernes').appendChild(horarioFormatted);
                break;
            case 'Sábado':
                document.getElementById('Sábado').appendChild(horarioFormatted);
                break;
        }
    });
}
    mostrarHorarios();
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

    function obtenerDatos2() {
    var form = document.querySelector('form');  // Asegúrate de que apuntas al formulario correcto

    // Limpiar inputs dinámicos previos para evitar duplicados
    document.querySelectorAll('.dynamic-input').forEach(input => input.remove());

    horarios2.forEach((item, index) => {
        var inputValue = `${item.dia} ${item.intervaloHoras}`;  // Formato "Día HoraInicio HoraFin"
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = `horarios2[]`;  // Usamos el mismo nombre sin índice para cada input
        input.value = inputValue;
        input.classList.add('dynamic-input');
        form.appendChild(input);
    });
}


/*function guardarHorario() {
        // Obtener los valores de las horas
        var horaInicio = document.getElementById('modalHoraInicio').value;
        var horaFin = document.getElementById('modalHoraFin').value;
        
        // Obtener el día del modal
        var dia = document.querySelector('.horarios').getAttribute('data-dia');
        
        // Actualizar la celda correspondiente con el intervalo de horas
        document.getElementById(dia).innerText = horaInicio + ' - ' + horaFin;
        
        // Cerrar el modal
        cerrarOtroModal();
    }*/
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
    
    // Crear el intervalo de horas como string
    var intervaloHoras = horaInicio + ' ' + horaFin;
    var intervalo = horaInicio + ' - ' + horaFin;
    
    // Obtener el día del modal
    var dia = document.querySelector('.horarios').getAttribute('data-dia');
    
    // Actualizar la celda correspondiente con el intervalo de horas
    document.getElementById(dia).innerText = intervalo;
    
    // Añadir el nuevo horario al arreglo
    horarios2.push(...horarios3);
    horarios2.push({dia, intervaloHoras});
    
    // Cerrar el modal
    cerrarOtroModal();
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
        verificarOtroAmbiente(select);
        verificarOtro(select);
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

{{-- modal cancelar --}}
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