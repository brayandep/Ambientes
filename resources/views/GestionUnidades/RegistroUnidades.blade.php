<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleUnidades.css') }}">
    <title>Gestionar unidades</title>
</head>
<body>
    <div class="contenedor">
        <div class="encabezado">
             aqui viene el encabezado
        </div>
        <div class="Navegacion-contenido">
            <div class="Navegacion">
            Inicio > Gestion de unidades > Registro de unidad
            </div>
        </div>
        <div class="registro-contenido">
            <div class=registro>
                <form action="{{route('unidad.store')}}" method="POST">
                @csrf
                    <div class="div1Label">
                            <h1 class=Titulo><i class="fas fa-building"></i> Registro de Unidad</h1>
                    
                            <label class="titulo"for="nombreUnidad">Nombre de la Unidad: </label>
                            <input class="imput" type="text" id="nombreUnidad" name="nombreUnidad" required maxlength="40" autocomplete="off">
                            
                            <label class="titulo" for="codigoUnidad">Codigo: </label>
                            <input class="imput" type="text" id="codigoUnidad" name="codigoUnidad" required maxlength="6" autocomplete="off">

                            <label class="titulo"for="Responsable">Responsable: </label>
                            <input class="imput" type="text" id="Responsable" name="Responsable" required maxlength="30" autocomplete="off">
                    </div>
                    <div class="div2Seleccion">
                        <div class="seleccion">
                            <label class="Titulo" for="Nivel">Nivel:</label>
                            <select class="imput" id="Nivel" name="Nivel">
                                <!-- Opciones de nivel aqu� -->
                                <option selected>Seleccione un nivel</option>
                                <option value="0">0  Facultad</option> 
                                <option value="1">1  Decanato</option> 
                                <option value="2">2  Departamento</option> 
                                <option value="3">3  laboratorio</option> 
                            </select>
                        </div>
                        <div class="seleccion">
                            <label class="Titulo" for="Dependencia">Dependencia:</label>
                            <select class="imput" id="Dependencia" name="Dependencia">
                                <!-- Opciones de dependeia aqu� -->
                                <option value="1">opcion 1</option> 
                                <option value="2">opcion 2</option> 
                                <option value="3">opcion 3</option> 
                                <option value="4">opcion 4</option> 
                            </select>
                        </div>
                    </div>
                    <div class="div3Botones">
                        <button class= "cancelar">Cancelar</button>
                        <button type="submit" class="registrar">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
            copyright R 2024, SmartByte.srl contactenos
            gmail:SmartByte626@gmail.com
            celular: 6857499 
        </div>
       
    </div>
    
</body>
<div id="fondoGris"></div>
<!--<div class="mensaje_emergente" >
            <div class="info">
                ¿Esta seguro que desea cancelar el registro?
            </div>
            <div class="div3">
                <button class= "cancelar">Cancelar</button>
                <button class="registrar">Aceptar</button>
            </div>
</div>
<div class="mensaje_emergente" >
            <div class="info">
                ¡El registro se guardo exitosamente!
            </div>
            <div class="div3">
                <button class="registrar">Cerrar</button>
            </div>
</div>-->
</html>