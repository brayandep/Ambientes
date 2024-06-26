<?php

use App\Http\Controllers\materiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\EstadoAmbienteController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\registroUnidadesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\DependenciaUnidadController;
use App\Models\Dependencia;

use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\RegistroController;
//login
use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\usuariocontroller;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\grupoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\BackupController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RolController;
use Spatie\Permission\Models\Permission;


use App\Http\Controllers\CorreoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/



//rutas unidade
Route::get('/Registrar_Unidad', function () {
    return view('GestionUnidades.RegistroUnidades');
})->middleware('can:Registrar unidad')->name('unidad.registrar');
Route::get('/Visualizar_Unidad',[registroUnidadesController::class, 'show'])->middleware('can:Ver unidad')->name('visualizar_unidad');
Route::post('/Registrar_Unidad',[registroUnidadesController::class, 'store'])->middleware('auth')->name('unidad.store');
Route::get('/unidad/dependencia/{nivel}',[DependenciaUnidadController::class, 'buscar'])->middleware('auth')->name('dependencia.buscar');
Route::get('/Editar_Unidad/{unidad}', [registroUnidadesController::class, 'edit'])->middleware('can:Editar unidad')->name('unidad.edit');
Route::delete('/Visualizar_Unidad/{unidad}',[registroUnidadesController::class, 'destroy'])->middleware('auth')->name('unidad.destroy');
Route::put('/Editar_unidad/{unidad}',[registroUnidadesController::class, 'update'])->middleware('auth')->name('unidad.update');
Route::put('/Visualizar_unidad/{unidad}',[registroUnidadesController::class, 'updateEstado'])->middleware('auth')->name('unidad.updateEstado');
Route::put('/unidad/{unidad}', [registroUnidadesController::class, 'habilitarEstado'])->middleware('auth')->name('unidad.habilitar');
Route::put('/unidad/toggle/{unidad}', [registroUnidadesController::class, 'toggleEstado'])->middleware('auth')->name('unidad.toggle');
//termina rutas unidades

// Route::get('/registro', function () {
//     return view('registro');
// })->name('registro');

//registrar solicitudes de ambientes
Route::get('/Solicitud', function () {
    return view('SolicitudAmbiente');
})->middleware('can:Solicitar ambiente')->name('SolicitudAmbiente');
//versolicitudes
Route::get('/Versolicitudes', [SolicitudController::class, 'index'])->middleware('can:Solicitar ambiente')->name('VerSolicitud');
Route::get('/Versolicitudes/{solicitud}/edit', [SolicitudController::class, 'edit'])->middleware('can:Solicitar ambiente')->name('solicitud.edit');
Route::put('/Versolicitudes/{solicitud}', [SolicitudController::class, 'update'])->middleware('auth')->name('solicitud.update');
Route::delete('/Versolicitudes/{solicitud}', [SolicitudController::class, 'destroy'])->middleware('auth')->name('solicitud.destroy');
//envia datos
Route::post('/registro', [RegistroController::class, 'store'])->middleware('auth')->name('registro.store');
Route::post('/Solicitud', [SolicitudController::class, 'store'])->middleware('auth')->name('solicitud.store');
Route::get('/Solicitud', [SolicitudController::class, 'create'])->middleware('can:Solicitar ambiente')->name('solicitud.create'); 


//rutas de materia
Route::get('materia', [materiaController::class, 'show'])->middleware('can:Ver materia')->name('materia.show');
Route::get('materia/registrar', [materiaController::class, 'create'])->middleware('can:Registrar materia')->name('materia.reg');
Route::post('materia', [materiaController::class, 'store'])->middleware('auth')->name('materia.store');
Route::get('materia/{materia}/editar', [materiaController::class, 'editar'])->middleware('can:Editar materia')->name('materia.editar');
Route::put('materia/{materia}', [materiaController::class, 'update'])->middleware('auth')->name('materia.update');
Route::put('materia/estado/{materia}', [materiaController::class, 'estado'])->middleware('auth')->name('materia.estado');
//termina rutas de materia

//rutas de grupo
Route::get('materia/{materia}/grupos', [grupoController::class, 'create'])->middleware('auth')->name('grupo.create');
Route::put('grupo/{cantGrupo}', [grupoController::class, 'update'])->middleware('auth')->name('grupo.update');
//termina rutas de grupo

Route::get('/Registro', function () {
    return view('registrarAmbiente.index');
})->name('registro');

Route::get('/ambiente/create', [AmbienteController::class, 'create'])->middleware('can:Registrar ambiente')->name('ambiente.create');
Route::post('/ambiente', [AmbienteController::class, 'store'])->middleware('auth')->name('ambiente.store');
Route::get('/ambiente/{id}', [AmbienteController::class, 'edit'])->middleware('can:Editar ambiente')->name('ambiente.edit');
Route::put('/ambiente/{id}', [AmbienteController::class, 'update'])->middleware('auth')->name('ambiente.update');

//rutas visualizacion ambientes
Route::get('/ver-ambientes',[EstadoAmbienteController::class, 'show'])->middleware('can:Ver ambiente')->name('AmbientesRegistrados');
Route::put('/cambiar-estado/{id}',[EstadoAmbienteController::class, 'cambiarEstado'])->middleware('can:Editar ambiente')->name('cambiar.estado');
//termina rutas visualizacion ambientes

//rutas buscador
Route::get('/busqueda-ambiente',[BuscadorController::class, 'show'])->name('buscador');

//rutas calendario
Route::get('/Calendario', [CalendarioController::class, 'index'])->name('calendario.index');
Route::get('/Calendario/Ambiente/{idAmbiente}', [CalendarioController::class, 'individual'])->name('calendario.individual');
Route::post('/Calendario/evento', [EventoController::class, 'store'])->middleware('auth')->name('evento.store');
Route::delete('/Calendario/evento/{id}', [EventoController::class, 'destroy'])->middleware('auth')->name('evento.delete');
Route::put('/Calendario/evento/{id}', [EventoController::class, 'update'])->middleware('auth')->name('evento.update');
//termina rutas calendario



//habilitar reservas
Route::get('/habilitar', [SolicitudController::class, 'index2'])->middleware('can:Ver reserva')->name('habilitarReservas');
Route::put('/suspender/{id}', [SolicitudController::class, 'suspender'])->middleware('auth')->name('solicitud.suspender');
//habilitar
Route::put('/habilitar/{id}', [SolicitudController::class, 'habilitar'])->middleware('auth')->name('solicitud.habilitar');
//denegar
Route::put('/denegar/{id}', [SolicitudController::class, 'denegar'])->middleware('auth')->name('solicitud.denegar');
Route::get('/denegar/{id}', [SolicitudController::class, 'edit'])->middleware('auth')->name('habilitar.ver');
//mostrar solicitudes filtro
Route::get('/mostrar', [SolicitudController::class, 'solicitudMostrar'])->middleware('auth')->name('solicitud.mostrar');
//prueba de encabezado
/*Route::get('/', function () {
    return view('Inicio');
})->name('inicio');*/

// Ruta para mostrar la página de inicio
Route::get('/', [InicioController::class, 'mostrarInicio'])->name('inicio');


// Rutas para las publicaciones


Route::get('/publicaciones', [PublicacionController::class, 'index'])->middleware('can:Registrar publicacion')->name('publicaciones.index');
Route::get('/publicaciones/crear', [PublicacionController::class, 'crear'])->middleware('can:Registrar publicacion')->name('crear.publicacion');
Route::post('/publicaciones', [PublicacionController::class, 'store'])->middleware('auth')->name('guardar.publicacion');
Route::get('/eliminar-publicacion/{id}', [PublicacionController::class, 'eliminarPublicacion'])->middleware('can:Eliminar publicacion')->name('eliminar.publicacion');
Route::get('/publicacion/{id}/ver', [PublicacionController::class, 'verArchivo'])->name('publicacion.ver');//ver sin restriccion
Route::put('/publicaciones/{id}', [PublicacionController::class, 'update'])->middleware('auth')->name('actualizar.publicacion');

//descargar pdf de reporte de ambientes registrados
Route::get('/descargar-ambientes-pdf', 'App\Http\Controllers\AmbienteController@descargarAmbientesPDF')->middleware('auth')->name('descargar.ambientes.pdf');
Route::get('/descargar-unidades-pdf', 'App\Http\Controllers\registroUnidadesController@descargarUnidadesPDF')->middleware('auth')->name('descargar.unidades.pdf');
Route::get('/descargar-materias-pdf', 'App\Http\Controllers\materiaController@descargarMateriasPDF')->middleware('auth')->name('descargar.materias.pdf');
Route::get('/descargar-reservas-pdf', 'App\Http\Controllers\SolicitudController@descargarReservasPDF')->middleware('auth')->name('descargar.reservas.pdf');
Route::put('/publicaciones/{id}', [PublicacionController::class, 'update'])->name('actualizar.publicacion');

Route::get('/publicaciones/{id}/editar', [PublicacionController::class, 'edit'])->name('editar.publicacion');

//rutas backup
Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
Route::post('/backup', [BackupController::class, 'store'])->name('backup.store');
Route::post('/backup/restore', [BackupController::class, 'restore'])->name('backup.restore');
Route::delete('/backup/{backupName}', [BackupController::class, 'destroy'])->name('backup.destroy');
Route::post('/backup/schedule', [BackupController::class, 'schedule'])->name('backup.schedule');
Route::post('/backup/schedule/delete', [BackupController::class, 'deleteSchedule'])->name('backup.schedule.delete');
Route::get('/run-backup', [BackupController::class, 'runBackup'])->name('run.backup');
//termina rutas backup


//Registrar roles nuevos
Route::get('/Registrar_rol', [RolController::class, 'verForm'])->middleware('can:Registrar rol')->name('Formulario.Rol');
Route::post('/Registrar_rol',[RolController::class, 'store'])->name('Rol.store');
Route::get('/Rol/lista',[RolController::class, 'index'])->middleware('can:Ver rol')->name('Rol.index');
Route::put('/Rol/habilitar/{id}',[RolController::class, 'habilitar'])->name('Rol.habilitar');
Route::get('/Rol/Permisos/{id}', [RolController::class, 'show']);




Route::get('/usuario', [usuariocontroller::class, 'index'])->middleware('can:Registrar usuario')->name('Usuario.index');

Route::get('/inicio', [usuariocontroller::class, 'index2'])->name('sesion.index');
Route::post('/iniciar-sesion',[LoginController::class, 'login'])->name('iniciar-sesion');
Route::post('/validar-registro',[LoginController::class, 'register'])->name('validar-registro');
Route::get('/iniciar-sesion/edit', [LoginController::class, 'edit'])->name('user.edit');
Route::post('/iniciar-sesion/update', [LoginController::class, 'update'])->name('user.update');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

//lista de usuario
Route::get('/usuario/lista', [usuariocontroller::class, 'show'])->middleware('can:Ver usuario')->name('Usuario.show');
Route::get('/usuario/roles/{usuario}', [usuariocontroller::class, 'edit'])->name('Usuario.edit');
Route::put('/usuario/roles/{usuario}', [usuariocontroller::class, 'update'])->name('Usuario.update');
//termina lista de usuario

//inicia enviar norificaciones
Route::post('/enviar-correo', [CorreoController::class, 'enviarCorreo'])->name('enviar.correo');
//finaliza enviar norificaciones
//inicia ruta para logs

Route::get('/logs', [LogController::class, 'index'])->name('Log.index');

//termina ruta para logs