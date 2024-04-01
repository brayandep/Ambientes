<?php

use App\Http\Controllers\materiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\EstadoAmbienteController;

use App\Http\Controllers\HomeController;
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

Route::get('/materia', materiaController::class);

Route::get('/Registro', function () {
    return view('registrarAmbiente.index');
})->name('registro');
Route::resource('/registro', AmbienteController::class);

Route::get('/ver-ambientes',[EstadoAmbienteController::class, 'show'])->name('AmbientesRegistrados');

