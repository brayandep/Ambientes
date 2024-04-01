@extends('layoutes.plantilla')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleVerAmbientes.css') }}">
@endsection

@section('titulo', 'Editar Ambiente')

@section('contenido')
<body class="fondoVer">
    <div class="historial">Gestionar Ambientes > Ver Ambientes Registrados</div>
    <!-- Título -->
    <h1 class="tituloVer">Ver Ambientes Registrados</h1>
  
    <!-- Tabla de Ambientes -->
    <div class="tabla">
    <table class="tablaVer">
        <div class="fila">
            <button class="nomCol">Codigo</button>
            <button class="nomCol">Unidad</button>
            <button class="nomCol">Nombre</button>
            <button class="nomCol">Capacidad</button>
            <button class="nomCol">Ubicación</button>
            <button class="nomCol">Descripción de ubicación</button>
            <button class="nomCol">Editar</button>
            <button class="nomCol">Habilitar</button>
        </div>
        <div>
            @foreach ($ambientes as $ambiente)
                <div class="fila">
                    <p>{{$ambiente->codigo}}</p>
                    <p>{{$ambiente->unidad}}</p>
                    <p>{{$ambiente->nombre}}</p>
                    <p>{{$ambiente->capacidad}}</p>
                    <p>{{$ambiente->ubicacion}}</p>
                    <p>{{$ambiente>descripcion_ubicacion}}</p>
                    <p>{{$ambiente->editar}}</p>
                    <div class="Edit">
                        <button class="editar" onclick="location.href='{{ route('registro.edit', $ambiente) }}';"><i class="fa-solid fa-pen-to-square"></i></button>
                      
                    </div>
                    <div class="Enable">
                        <button class="habilitar"><i class="fa-solid fa-pen-to-square"></i></button>
                        
                    </div>
                </div>
            @endforeach
        </div>
</body>
@endsection



