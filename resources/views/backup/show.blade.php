@extends('layoutes.plantilla')

@section('titulo', 'Ver Backup')

@section('contenido')
    <div class="contenido-backup">
        <div class="visualizar-backup">
            <h1 class="Titulo-backup"><i class="fa-solid fa-database"></i> Contenido del Backup </h1>
            <textarea rows="20" cols="80">{{ $backupContent }}</textarea>
            <br>
            <a href="{{ route('backup.index') }}">Volver al listado de backups</a>
        </div>
    </div>
@endsection
