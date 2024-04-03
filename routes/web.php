<?php

use App\Http\Controllers\materiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\registroUnidadesController;
use App\Http\Controllers\DependenciaUnidadController;
use App\Models\Dependencia;

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
Route::get('/index', function () {
    return view('sliderBar');
});
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

//prueba de encabezado
Route::get('/', function () {
    return view('Inicio');
})->name('inicio');

Route::get('/materia', materiaController::class);
