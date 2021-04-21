<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LocalidadesController;
use App\Http\Controllers\SeccionesController;
use App\Http\Controllers\PromotoresController;
use App\Http\Controllers\SimpatizantesController;

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

Route::middleware(['isLogin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::middleware(['isAdmin'])->group(function () {
        // USUARIOS
        Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios');
        Route::post('/usuarios', [UsuariosController::class, 'listarUsuarios']);
        Route::put('/usuarios', [UsuariosController::class, 'guardarUsuario']);
        Route::delete('/usuarios', [UsuariosController::class, 'eliminarUsuario']);
        Route::post('/usuarios/bloquear', [UsuariosController::class, 'bloquearUsuario']);

        // LOCALIDADES
        Route::get('/localidades', [LocalidadesController::class, 'index'])->name('localidades');
        Route::post('/localidades', [LocalidadesController::class, 'listar']);
        Route::put('/localidades', [LocalidadesController::class, 'guardar']);
        Route::delete('/localidades', [LocalidadesController::class, 'eliminar']);

        //SECCIONES
        Route::get('/secciones', [SeccionesController::class, 'index'])->name('localidades');
        Route::post('/secciones', [SeccionesController::class, 'listar']);
        Route::put('/secciones', [SeccionesController::class, 'guardar']);
        Route::delete('/secciones', [SeccionesController::class, 'eliminar']);

    });

    //LIVE SEARCH
    Route::get('/promotores/autocomplete', [PromotoresController::class, 'autocomplete']);
    Route::get('/localidades/autocomplete', [LocalidadesController::class, 'autocomplete']);
    Route::get('/secciones/autocomplete', [SeccionesController::class, 'autocomplete']);

    //SIMPATIZANTES
    Route::get('/simpatizantes', [SimpatizantesController::class, 'index'])->name('simpatizantes');
    Route::post('/simpatizantes', [SimpatizantesController::class, 'listar']);
    Route::put('/simpatizantes', [SimpatizantesController::class, 'guardar']);
    Route::delete('/simpatizantes', [SimpatizantesController::class, 'eliminar']);
    Route::put('/simpatizantes/documentos', [SimpatizantesController::class, 'subirDocumento']);

    //PROMOTORES
    Route::get('/promotores', [PromotoresController::class, 'index'])->name('promotores');
    Route::post('/promotores', [PromotoresController::class, 'listar']);
    Route::put('/promotores', [PromotoresController::class, 'guardar']);
    Route::delete('/promotores', [PromotoresController::class, 'eliminar']);

});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);