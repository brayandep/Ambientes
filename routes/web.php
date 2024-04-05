<?php

use App\Http\Controllers\materiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\EstadoAmbienteController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\registroUnidadesController;
use App\Http\Controllers\DependenciaUnidadController;
use App\Models\Dependencia;

use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\grupoController;

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

<<<<<<< HEAD
Route::get('/', [HomeController::class, 'index'])->name('inicio');
/*
*/
=======
Route::get('/', function () {
    return view('Inicio');
})->name('inicio');

Route::get('/index', function () {
    return view('sliderBar');
});
>>>>>>> katherine



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

Route::get('/registro', function () {
    return view('registro');
})->name('registro');
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
Route::get('/', function () {
    return view('Inicio');
})->name('inicio');

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

Route::resource('/registro', AmbienteController::class);

Route::get('/ver-ambientes',[EstadoAmbienteController::class, 'show'])->name('AmbientesRegistrados');

Route::put('/cambiar-estado/{id}', [EstadoAmbienteController::class, 'cambiarEstado'])->name('cambiar.estado');

<<<<<<< HEAD
//Route::post('/Registrar_Unidad',[AmbienteController::class, 'store'])->name('unidad.store');

=======
Route::post('/Registrar_Unidad',[AmbienteController::class, 'store'])->name('unidad.store');
>>>>>>> katherine
