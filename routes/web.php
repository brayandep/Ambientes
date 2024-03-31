<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\registroUnidadesController;

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
});

Route::get('/Visualizar_Unidad', function () {
    return view('GestionUnidades.VisualizarUnidades');
})->name('visualizar_unidad');
Route::post('/Registrar_Unidad',[registroUnidadesController::class, 'store'])->name('unidad.store');
//prueba de encabezado
Route::get('/', function () {
    return view('web');
});
