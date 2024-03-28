<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/index', function () {
    return view('sliderBar');
});
Route::get('/Registrar_Unidad', function () {
    return view('RegistroUnidades');
});
Route::get('/Visualizar_Unidad', function () {
    return view('VisualizarUnidades');
});

//prueba de encabezado
Route::get('/', function () {
    return view('web');
});
