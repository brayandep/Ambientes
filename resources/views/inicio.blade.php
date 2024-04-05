@extends('layoutes.plantilla')

@section('estilos')
    <style>
        .ini{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center; 
            flex-direction: column;	
            gap: 20px;
        }
        .mensajeIni{
            font-weight: bold;
            font-size: 42px;
        }
        .logo2{
            width: 200px;
            height: auto;
            
        }
    </style>
@endsection

@section('contenido')
    <div class="ini">
        <img src="{{asset('images\logo.png')}}" alt="Logo" class="logo2">
        <h1 class="mensajeIni">Inicio Smart Byte</h1>
    </div>
@endsection