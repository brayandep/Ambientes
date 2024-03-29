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
                <div class="div1">
                        <h1 class=Titulo><i class="fas fa-building"></i> Registro de Unidad</h1>
                
                        <label class="titulo"for="Nombre">Nombre de la Unidad: </label>
                        <input class="imput" type="text" id="Nombre" name="Nombre" required maxlength="40" autocomplete="off">
                        
                        <label class="titulo" for="codigo">Codigo: </label>
                        <input class="imput" type="text" id="codigo" name="codigo" required maxlength="6" autocomplete="off">

                        <label class="titulo"for="responsable">Responsable: </label>
                        <input class="imput" type="text" id="responsable" name="responsable" required maxlength="30" autocomplete="off">
                </div>
                <div class="div2">
                    <div class="seleccion">
                        <label class="Titulo" for="nivel">Nivel:</label>
                        <select class="imput" id="nivel" name="nivel">
                            <!-- Opciones de nivel aqu� -->
                            <option value="0">0  Facultad</option> 
                            <option value="1">1  Decanato</option> 
                            <option value="2">2  Departamento</option> 
                            <option value="3">3  laboratorio</option> 
                        </select>
                    </div>
                    <div class="seleccion">
                        <label class="Titulo" for="dependencia">Dependencia:</label>
                        <select class="imput" id="dependencia" name="dependencia">
                            <!-- Opciones de dependeia aqu� -->
                            <option value="1">opcion 1</option> 
                            <option value="2">opcion 1</option> 
                            <option value="3">opcion 1</option> 
                            <option value="4">opcion 1</option> 
                        </select>
                    </div>
                </div>
                <div class="div3">
                    <button class= "cancelar">Cancelar</button>
                    <button class="registrar">Registrar</button>
                </div>
            </div>
        </div>
        <div class="footer">
        aqui viene el footer
        </div>
    </div>
</body>
</html>