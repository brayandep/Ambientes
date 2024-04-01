<?php

use App\Http\Controllers\materiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\buscadorController
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

Route::get('/materia', materiaController::class);

//prueba de encabezado
Route::get('/', function () {
    return view('web');
});


Route::get('/', function () {
    return view('welcome');
})->name('pagina_principal');

Route::get('/gestion-ambiente', function () {
    // Lógica para la gestión de ambientes
})->name('gestion_ambiente');

Route::get('/gestion-reserva', function () {
    // Lógica para la gestión de reservas
})->name('gestion_reserva');

Route::get('/buscar_ambientes', buscadorController::class {
    return view('buscador');
})->name('buscar_ambientes');
