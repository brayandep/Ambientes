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

            <div class="boton-backup">
                <form action="{{ route('backup.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="generar-backup">Generar Backup</button>
                </form>
            </div>
            <div class="tabla-backup">
                <div class="fila-backup">
                    <div class="contBotones" id="columnaGrande">
                        <button class="nomCol-backup">Nombre del archivo</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-backup">Restaurar</button>
                    </div>
                    <div class="contBotones" id="columnaPeque">
                        <button class="nomCol-backup">Eliminar</button>
                    </div>
                </div>
                <div class="datos-backup">
                    @foreach($backups as $backup)
                        <div class="fila-backup">
                            <p>{{ $backup }}</p>
                            <div id="columnaPeque" class="accion-backup">
                                <form action="{{ route('backup.restore') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="restorePoint" value="{{ $backup }}">
                                    <button type="submit" class="accion">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                    </button>
                                </form>
                            </div>
                            <div id="columnaPeque" class="accion-backup">
                                <form action="{{ route('backup.destroy', $backup) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="accion">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection