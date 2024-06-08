@extends('layoutes.plantilla')

@section('titulo', 'Backups')

@section('links')
    <link rel="stylesheet" href="../../css/styleBackup.css">
@endsection

@section('contenido')
    <div class="Navegacion-backup">
        <div class="Navegacion-contenido-backup">
            Administrador > Backup
        </div>
    </div>
    
    <div class="contenido-backup">
        <div class="visualizar-backup">
            <div>
                <h1 class="Titulo-backup"><i class="fa-solid fa-database"></i> Backups del Sistema </h1>
            </div>

            <div class="programar-backup-contenido">
                <div>
                    <h2>Programar Backup:</h2>
                </div>
                <form action="{{ route('backup.schedule') }}" method="POST">
                    @csrf
                    <div class="form-fila-backup">
                        <div class="input-group">
                            <label for="dia">Día de la semana:</label>
                            <select name="dia" id="dia">
                                <option value="">Seleccionar día</option>
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>
                            </select>
                            @error('dia')
                                <span class="msgError">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="hora">Hora:</label>
                            <input type="time" name="hora" id="hora">
                            @error('hora')
                                <span class="msgError">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="bton-fila-backup">
                            <button type="submit" class="programar-backup">Programar</button>
                    </div>
                </form>
            
                <div class="backup-programado">
                    @if (file_exists(storage_path('app/backup_schedule.json')))
                        @php
                            $config = json_decode(file_get_contents(storage_path('app/backup_schedule.json')), true);
                            $dia = $config['diaVer'];
                            $hora = $config['hora'];
                        @endphp
                        <div class="backup-info">
                            <h2>Backup programado: {{ ucfirst($dia) }} a las {{ $hora }}</h2>
                            <form action="{{ route('backup.schedule.delete') }}" method="POST">
                                @csrf
                                <button type="submit" class="eliminar-programar"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    @else
                        <h2 style="font-size: 16px; color: #0b2337;">Backup programado: No establecido</h2>
                    @endif
                </div>
            </div>
            
            <div class="boton-backup">
                <form action="{{ route('backup.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="generar-backup">Generar Backup</button>
                </form>
            </div>

            <div class="tabla-backup">
                <div class="fila-backup">
                    <div class="contBotones" id="columnaGrande">
                        <button class="nomCol-backup" id="noActivar">Nombre del archivo</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-backup" id="noActivar">Restaurar</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-backup" id="noActivar">Eliminar</button>
                    </div>
                </div>
                <div class="datos-backup">
                    @foreach($backups as $backup)
                        <div class="fila-backup">
                            <p class="contBotones">{{ $backup }}</p>
                            <div id="columnaPeque" class="accion-backup">
                                <form id="restaurarForm_{{ $backup }}" action="{{ route('backup.restore') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="restorePoint" value="{{ $backup }}">
                                    <button type="button" class="accion" onclick="RestaurarBackup('{{ $backup }}')">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                    </button>
                                </form>
                            </div>
                            <div id="columnaPeque" class="accion-backup">
                                <form id="eliminarForm_{{ $backup }}" action="{{ route('backup.destroy', $backup) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="accion" onclick="EliminarBackup('{{ $backup }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="fondoGris"></div>
        <div class="panel" id="panelEliminar">
              <p>¿Esta seguro que desea eliminar el backup de forma permanente?</p>
              <div class="btnPanel">
                <button class= "no" onclick="cancelarEliminar()" >No</button>
                <button class="si" onclick="confirmarEliminar()">Si</button>
            </div>
        </div>
        <div class="panel" id="panelRestaurar">
            <p>¿Está seguro que desea restaurar el backup a la fecha y hora indicada?</p>
            <div class="btnPanel">
                <button class= "no" onclick="cancelarRestaurar()" >No</button>
                <button class="si" onclick="confirmarRestaurar()">Si</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
{{-- modal restaurar y eleminar--}}
<script>
    let backupToDelete;
    let backupToRestore;

    function EliminarBackup(backup){
        backupToDelete = backup;
        panelEliminar.style.display = 'block';
        fondoGris.style.display = 'flex';
    }
    
    function cancelarEliminar(){
        panelEliminar.style.display  = 'none';
        fondoGris.style.display = 'none';
    }

    function confirmarEliminar() {
        const formId = 'eliminarForm_' + backupToDelete;
        document.getElementById(formId).submit();
    }

    function RestaurarBackup(backup){
        backupToRestore = backup;
        panelRestaurar.style.display = 'block';
        fondoGris.style.display = 'flex';
    }

    function cancelarRestaurar(){
        panelRestaurar.style.display  = 'none';
        fondoGris.style.display = 'none';
    }

    function confirmarRestaurar() {
        const formId = 'restaurarForm_' + backupToRestore;
        document.getElementById(formId).submit();
    }
</script>
@endsection