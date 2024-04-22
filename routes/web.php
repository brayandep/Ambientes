<?php

use App\Http\Controllers\materiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\registroUnidadesController;
use App\Http\Controllers\InicioController;

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

Route::get('/Editar_Unidad/{unidad}', [registroUnidadesController::class, 'edit'])->name('unidad.edit');

Route::delete('/Visualizar_Unidad/{unidad}',[registroUnidadesController::class, 'destroy'])->name('unidad.destroy');
//prueba de encabezado
/*Route::get('/', function () {
    return view('Inicio');
})->name('inicio');*/



// Ruta para mostrar la página de inicio
Route::get('/', [InicioController::class, 'mostrarInicio'])->name('inicio');


Route::get('/materia', materiaController::class);


// Rutas para las publicaciones


Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::get('/publicaciones/crear', [PublicacionController::class, 'crear'])->name('crear.publicacion');
Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('guardar.publicacion');
//Route::get('/editar/publicacion/{id}', 'PublicacionController@editar')->name('editar.publicacion');
Route::get('/publicaciones/{id}', [PublicacionController::class, 'obtenerDetalles'])->name('publicaciones.detalles');

Route::get('/eliminar-publicacion/{id}', [PublicacionController::class, 'eliminarPublicacion'])->name('eliminar.publicacion');


Route::get('/publicacion/{id}/ver', [PublicacionController::class, 'verArchivo'])->name('publicacion.ver');
