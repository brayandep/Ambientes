@extends('layoutes.plantilla')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesbrayan.css') }}">
@endsection


@section('titulo', 'Formulario de Solicitud')


@section('contenido')

<h2 class="titulo">Formulario de Solicitud</h2>
<div class="container">
 <form class="container" method="POST" action="{{ route('solicitud.store') }}">

         @csrf <!-- Incluye el campo csrf aquí -->
         <div class="izq">
         <div>
            <label class="text" for="nro_aula">Usuario:</label><br>
             <select class="input" id="usuario" name="usuario">
                 <option>Selecciona un usuario </option>
                 @foreach($usuarios as $usuario)
                   <option value="{{ $usuario->nombre}}" {{ isset($nombre) ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                 @endforeach
                  
               </select>
         </div>
            
             <br>
             <br>
             <br>
             <div>
                <select class="input"  id="nro_aula" name="nro_aula">
                    <option>Selecciona un ambiente </option>
                    @foreach($ambientes as $ambiente)
                      <option value="{{ $ambiente->nombre}}" {{ isset($nombre) ? 'selected' : '' }}>{{ $ambiente->nombre }}</option>
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
                <label class="text" for="horario">Horario:</label><br>
                <input class="input" type="text" id="horario" name="horario" placeholder="HH:MM - HH:MM" required>
            </div>
         </div>
         <div class="der">
             <div>
                 <label for="grupo">Grupo:</label><br>
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
             <div>
                <label class="text" for="fecha">Fecha:</label><br>
                <input class="input" type="date" id="fecha" name="fecha" required>
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
@endsection


