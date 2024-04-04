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
             <input class="input" type="text" id="usuario" value="{{$solicitud->usuario}}" name="usuario" required>
             <br>
             <br>
             <br>
             <div>
                 <label class="text" for="nro_aula">Número de Aula:</label><br>
                 <input class="input" type="text" id="nro_aula" name="nro_aula" value="{{$solicitud->nro_aula}}" required>
             </div>
             <br>
             <br>
             <div>
                 <label class="text" for="materia">Materia:</label><br>
                 <input class="input" type="text" id="materia" name="materia" value="{{$solicitud->materia}}" required>
             </div>
             <br>
             <br>
             <div>
                <label class="text" for="horario">Horario:</label><br>
                <input class="input" type="text" id="horario" name="horario" placeholder="HH:MM - HH:MM"  value="{{$solicitud->horario}}"required>
            </div>
         </div>
         <div class="der">
             <div>
                 <label for="grupo">Grupo:</label><br>
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
             <div>
                 <label class="text" for="fecha">Fecha:</label><br>
                 <input class="input" type="date" id="fecha" name="fecha"  value="{{$solicitud->fecha}}" required>
             </div>
             <br>
            
             <br>
         </div>
         <button class="boton" type="submit">Actualizar Solicitud</button>   
     </form>  
</div>    

@endsection


