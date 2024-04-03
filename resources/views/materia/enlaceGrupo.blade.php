@extends('layoutes.plantilla')

@section('titulo', 'Registrar Materia')

@section('links')
    <link rel="stylesheet" href="{{asset('css/styleMateria.css')}}">
    <link rel="stylesheet" href="{{asset('css/styleGrupo.css')}}">
@endsection

@section('estilos')
    {{-- Aqui vendran estilos --}}
@endsection

@section('contenido')
    <main>
        <div class="primerDiv">
            <div class="navegacion">
                Inicio > Materia > Grupos
            </div>
            <h1><i class='fas fa-book'></i> Grupos de {{$mimateria->nombre}}</h1>
            
            @foreach ($grupos as $grupo)
                <div class="input-goup">
                    <h2 class="grupo" id="labMateria">Grupo {{$grupo->nombre}}</h2>
                </div>

                <form action="{{route('grupo.store', $grupo)}}" method="POST" class="grupo" id="grupo{{$grupo->nombre}}">
                    @csrf
                    @method('put')
                    <input class="invisible" value="{{$grupo->nombre}}">

                    <div class="input-goup">
                        <label class="labMateria">Docente</label>
                        <select class="inputMateria" id="nivel" name="docente">
                            <option value="">Seleccione el nivel</option> 
                            <option value="{{old('docente', $grupo->docente)}}" selected>{{old('docente', $grupo->docente)}}</option>
                            <option value="SORUCO MAITA JOSE ANTONIO">SORUCO MAITA JOSE ANTONIO</option> 
                            <option value="OMONTE OJALVO JOSE ROBERTO">OMONTE OJALVO JOSE ROBERTO</option> 
                            <option value="MOREIRA CALIZAYA RENE">MOREIRA CALIZAYA RENE</option>
                            <option value="TERRAZAS VARGAS JUAN CARLOS">TERRAZAS VARGAS JUAN CARLOS</option> 
                            <option value="LEON ROMERO GUALBERTO">LEON ROMERO GUALBERTO</option> 
                        </select>
                        @error('docente')
                            <span class="msgError">*{{$message}}</span>
                            <br>
                        @enderror
                    </div>

                    <input class="invisible" value="{{$grupo->materia}}">
                </form>
                <hr>
            @endforeach 

            <div class="botones">
                <button onclick="CancelarReg()" type="button" class="btnCancelar">Cancelar</button>
                <button onclick="regGrupos()" id='btnGrupos' class="btnRegistrar">Actualizar Materia</button>
            </div>
        </div>

        <div id="fondoGris"></div>
        <div class="panel" id="panelCancelar">
            <p>¿Esta seguro que desea cancelar la asignacion de grupos?</p>
            <div class="btnPanel">
                <button class= "no" onclick="noCancela()" >No</button>
                <button class="si" onclick="location.href='{{ route('materia.show') }}';">Si</button>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{asset('js/scriptMateria.js')}}"></script>
@endsection
