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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\grupoController;

use App\Http\Controllers\BackupController;
use App\Http\Controllers\RolController;
use Spatie\Permission\Models\Permission;


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
Route::get('/', function () {
    return view('Inicio');
})->name('inicio');

Route::get('/index', function () {
    return view('sliderBar');
});


//rutas unidades
Route::get('/Registrar_Unidad', function () {
    return view('GestionUnidades.RegistroUnidades');
})->name('unidad.registrar');
Route::get('/Visualizar_Unidad',[registroUnidadesController::class, 'show'])->name('visualizar_unidad');
Route::post('/Registrar_Unidad',[registroUnidadesController::class, 'store'])->name('unidad.store');
Route::get('/unidad/dependencia/{nivel}',[DependenciaUnidadController::class, 'buscar'])->name('dependencia.buscar');
Route::get('/Editar_Unidad/{unidad}', [registroUnidadesController::class, 'edit'])->name('unidad.edit');
Route::delete('/Visualizar_Unidad/{unidad}',[registroUnidadesController::class, 'destroy'])->name('unidad.destroy');
Route::put('/Editar_unidad/{unidad}',[registroUnidadesController::class, 'update'])->name('unidad.update');
Route::put('/Visualizar_unidad/{unidad}',[registroUnidadesController::class, 'updateEstado'])->name('unidad.updateEstado');
Route::put('/unidad/{unidad}', [registroUnidadesController::class, 'habilitarEstado'])->name('unidad.habilitar');
Route::put('/unidad/toggle/{unidad}', [registroUnidadesController::class, 'toggleEstado'])->name('unidad.toggle');
//termina rutas unidades

// Route::get('/registro', function () {
//     return view('registro');
// })->name('registro');

//registrar solicitudes de ambientes
Route::get('/Solicitud', function () {
    return view('SolicitudAmbiente');
})->name('SolicitudAmbiente');
//versolicitudes
Route::get('/Versolicitudes', [SolicitudController::class, 'index'])->name('VerSolicitud');
Route::get('/Versolicitudes/{solicitud}/edit', [SolicitudController::class, 'edit'])->name('solicitud.edit');
Route::put('/Versolicitudes/{solicitud}', [SolicitudController::class, 'update'])->name('solicitud.update');
Route::delete('/Versolicitudes/{solicitud}', [SolicitudController::class, 'destroy'])->name('solicitud.destroy');
//envia datos
Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');
Route::post('/Solicitud', [SolicitudController::class, 'store'])->name('solicitud.store');
Route::get('/Solicitud', [SolicitudController::class, 'create'])->name('solicitud.create'); 


//rutas de materia
Route::get('materia', [materiaController::class, 'show'])->name('materia.show');
Route::get('materia/registrar', [materiaController::class, 'create'])->name('materia.reg');
Route::post('materia', [materiaController::class, 'store'])->name('materia.store');
Route::get('materia/{materia}/editar', [materiaController::class, 'editar'])->name('materia.editar');
Route::put('materia/{materia}', [materiaController::class, 'update'])->name('materia.update');
//termina rutas de materia

//rutas de grupo
Route::get('materia/{materia}/grupos', [grupoController::class, 'create'])->name('grupo.create');
Route::put('grupo/{cantGrupo}', [grupoController::class, 'jhosemar'])->name('grupo.update');
//termina rutas de grupo

Route::get('/Registro', function () {
    return view('registrarAmbiente.index');
})->name('registro');

Route::get('/ambiente/create', [AmbienteController::class, 'create'])->name('ambiente.create');
Route::post('/ambiente', [AmbienteController::class, 'store'])->name('ambiente.store');
Route::get('/ambiente/{id}', [AmbienteController::class, 'edit'])->name('ambiente.edit');
Route::put('/ambiente/{id}', [AmbienteController::class, 'update'])->name('ambiente.update');

//rutas visualizacion ambientes
Route::get('/ver-ambientes',[EstadoAmbienteController::class, 'show'])->name('AmbientesRegistrados');
Route::put('/cambiar-estado/{id}',[EstadoAmbienteController::class, 'cambiarEstado'])->name('cambiar.estado');
//termina rutas visualizacion ambientes

//rutas buscador
Route::get('/busqueda-ambiente',[BuscadorController::class, 'show'])->name('buscador');
//termina rutas buscador

//rutas calendario
Route::get('/Calendario', [CalendarioController::class, 'index'])->name('calendario.index');
Route::get('/Calendario/Ambiente/{idAmbiente}', [CalendarioController::class, 'individual'])->name('calendario.individual');
Route::post('/Calendario/evento', [EventoController::class, 'store'])->name('evento.store');
Route::delete('/Calendario/evento/{id}', [EventoController::class, 'destroy'])->name('evento.delete');
Route::put('/Calendario/evento/{id}', [EventoController::class, 'update'])->name('evento.update');
//termina rutas calendario



//habilitar reservas
Route::get('/habilitar', [SolicitudController::class, 'index2'])->name('habilitarReservas');
Route::put('/suspender/{id}', [SolicitudController::class, 'suspender'])->name('solicitud.suspender');
//habilitar
Route::put('/habilitar/{id}', [SolicitudController::class, 'habilitar'])->name('solicitud.habilitar');
//denegar
Route::put('/denegar/{id}', [SolicitudController::class, 'denegar'])->name('solicitud.denegar');
Route::get('/denegar/{id}', [SolicitudController::class, 'edit'])->name('habilitar.ver');
//mostrar solicitudes filtro
Route::get('/mostrar', [SolicitudController::class, 'solicitudMostrar'])->name('solicitud.mostrar');
//prueba de encabezado
/*Route::get('/', function () {
    return view('Inicio');
})->name('inicio');*/

// Ruta para mostrar la página de inicio
Route::get('/', [InicioController::class, 'mostrarInicio'])->name('inicio');

// Rutas para las publicaciones


Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::get('/publicaciones/crear', [PublicacionController::class, 'crear'])->name('crear.publicacion');
Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('guardar.publicacion');
Route::get('/eliminar-publicacion/{id}', [PublicacionController::class, 'eliminarPublicacion'])->name('eliminar.publicacion');


Route::get('/publicacion/{id}/ver', [PublicacionController::class, 'verArchivo'])->name('publicacion.ver');
//descargar pdf de reporte de ambientes registrados
Route::get('/descargar-ambientes-pdf', 'App\Http\Controllers\AmbienteController@descargarAmbientesPDF')->name('descargar.ambientes.pdf');
Route::get('/descargar-unidades-pdf', 'App\Http\Controllers\registroUnidadesController@descargarUnidadesPDF')->name('descargar.unidades.pdf');
Route::get('/descargar-materias-pdf', 'App\Http\Controllers\materiaController@descargarMateriasPDF')->name('descargar.materias.pdf');
Route::get('/descargar-reservas-pdf', 'App\Http\Controllers\SolicitudController@descargarReservasPDF')->name('descargar.reservas.pdf');
Route::put('/publicaciones/{id}', [PublicacionController::class, 'update'])->name('actualizar.publicacion');

Route::get('/publicaciones/{id}/editar', [PublicacionController::class, 'edit'])->name('editar.publicacion');

//rutas backup
Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
Route::post('/backup', [BackupController::class, 'store'])->name('backup.store');
Route::post('/backup/restore', [BackupController::class, 'restore'])->name('backup.restore');
Route::delete('/backup/{backupName}', [BackupController::class, 'destroy'])->name('backup.destroy');
Route::get('/backup/{backupName}', [BackupController::class, 'show'])->name('backup.show');
//termina rutas backup


//Registrar roles nuevos
Route::get('/Registrar_rol', [RolController::class, 'verForm'])->name('Formulario.Rol');
Route::post('/Registrar_rol',[RolController::class, 'store'])->name('Rol.store');
Route::get('/Rol/lista',[RolController::class, 'index'])->name('Rol.index');
Route::put('/Rol/habilitar/{id}',[RolController::class, 'habilitar'])->name('Rol.habilitar');
Route::get('/Rol/Permisos/{id}', [RolController::class, 'show']);


