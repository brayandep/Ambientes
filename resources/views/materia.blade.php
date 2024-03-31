<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/styleMateria.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>SmartByte</title>
</head>
<body>
    <div class="contenedor">
        <div class="izquierda" id="menu">
            <nav class="menu" >
                <ul>
                    <li>
                        <a href="#"><i class='fas fa-home'></i> Inicio</a>
                        
                    </li>
                    <li>
                        <a href="#"><i class='fas fa-search'></i> Buscar</a>
                    </li>
                    <li onclick="gesAmbiente()">
                        <p><i class='fas fa-clipboard'></i> Gestionar Ambiente</p>
                        
                    </li>
                    <nav class="subMenu" id="sub1">
                        <ul>
                            <li>
                                <a href="#"><i class='fas fa-clipboard'></i> Registrar Ambiente</a>
                            </li>
                            <li>
                                <a href="#"><i class='fas fa-pen-to-square'></i> Editar Informacion de ambiente</a>
                            </li>
                        </ul>
                    </nav>
                    <li onclick="gesUnidad()">
                        <p><i class='fas fa-clipboard'></i> Registrar Nueva Unidad</p>
                    </li>
                    <nav class="subMenu" id="sub2">
                        <ul>
                            <li>
                                <a href="#"><i class="fas fa-building"></i> Registrar Facultad</a>
                            </li>
                            <li>
                                <a href="#"><i class='fas fa-graduation-cap'></i> Registrar Carrera</a>
                            </li>
                            <li>
                                <a href="#"><i class='fas fa-book'></i> Registrar Materia</a>
                            </li>
                            <li>
                                <a href="#"><i class="fas fa-user-group"></i> Registrar Grupo</a>
                            </li>
                        </ul>
                    </nav>
                    <li>
                        <p><i class='fas fa-clipboard'></i> Solicitar Reserva</p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="derecha">
            <header>
                <h1 id="btnMenu" onclick="desMenu()"><i class='fas fa-bars'></i> Menu</h1>
                <i class='fas fa-user'></i>
            </header>
            <br>
            <main>
                <div>
                    <h1><i class='fas fa-book'></i> Registrar Materia</h1>
                    <form class="materia" method="POST" enctype="multipart/form-data" id="materia">
                        <div class="input-group">
                            <label class="labMateria">Departamento</label>
                            <select class="inputMateria" id="departamento" name="departamento">
                                <option value="">Seleccione una opcion</option> 
                                <option value="2022">2022</option> 
                                <option value="2021">2021</option> 
                                <option value="2020">2020</option> 
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="labMateria">Carrera</label>
                            <select class="inputMateria" id="carrera" name="carrera">
                                <option value="">Seleccione una opcion</option> 
                                <option value="2023">Ing. de Sistemas</option> 
                                <option value="2022">Ing. Informatica</option> 
                                <option value="2021">Ing. Industrial</option> 
                                <option value="2020">Ing. Quimica</option> 
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="labMateria" id="labMateria">Nombre</label>
                            <input required name="nombre" class="inputMateria" id="nomPl" placeholder="Max. 100 caracteres" oninput="verificarContorno(this)">
                        </div>
                        <div class="input-group">
                            <label class="labMateria" id="labMateria">Codigo</label>
                            <input required name="codigo" autocomplete="off" class="inputMateria" id="nomPl" placeholder="Max. 100 caracteres" oninput="verificarContorno(this)">
                        </div>

                        <div class="input-group">
                            <label class="labMateria">Nivel</label>
                            <select class="inputMateria" id="nivel" name="nivel">
                                <option value="">Seleccione una opcion</option> 
                                <option value="2022">2022</option> 
                                <option value="2021">2021</option> 
                                <option value="2020">2020</option> 
                            </select>

                            <label class="labMateria">Grupo</label>
                            <select class="inputMateria" id="grupo" name="grupo">
                                <option value="">Seleccione una opcion</option> 
                                <option value="2022">2022</option> 
                                <option value="2021">2021</option> 
                                <option value="2020">2020</option> 
                            </select>
                        </div>
                        
                        <div class="botones">
                            <button onclick="enviarFormulario()" type="button" class="btnCancelar">Cancelar</button>
                            <button onclick="enviarFormulario()" type="button" class="btnRegistrar">Registrar</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <footer>
        <br>
        <p>Este es un footer</p>
    </footer>
</body>
<script src="{{asset('js/scriptMateria.js')}}"></script>
</html>

