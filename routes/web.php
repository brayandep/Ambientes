<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\Auth\LoginController;
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


//prueba de encabezado
Route::get('/', function () {
    return view('sliderBar');
});

Route::get('/login', [LoginController::class, 'index'])->name('Login');
Route::post('/login', [LoginController::class, 'Login']);
Route::get('/dashboard', function () {
    // Esta ruta solo será accesible para usuarios autenticados
})->middleware('auth');

//Route::get('/solicitud', 'SolicitudController')->name('solicitud.index');
//Route::post('/solicitud', 'SolicitudController@store')->name('solicitud.store');


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
/*Route::get('/Versolicitudes', function () {
    return view('Versolicitud');
})->name('VerSolicitud');
*/

//envia datos
Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');
Route::post('/Solicitud', [SolicitudController::class, 'store'])->name('solicitud.store');