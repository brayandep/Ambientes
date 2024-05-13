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
            <div>
                <form action="{{ route('backup.store') }}" method="POST">
                    @csrf
                    <button type="submit">Generar Backup</button>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre del archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backups as $backup)
                        <tr>
                            <td>{{ $backup }}</td>
                            <td>
                                <form action="{{ route('backup.restore') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="restorePoint" value="{{ $backup }}">
                                    <button type="submit">Restaurar</button>
                                </form>
                                <form action="{{ route('backup.destroy', $backup) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection