<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\ExtrasController;
use App\Http\Controllers\FuncionesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//rutas de peliculas
Route::middleware('auth')->group(function () {
    Route::get('/', [PeliculasController::class, 'index'])->name('peliculas');
    Route::get('/peliculas', [PeliculasController::class, 'index'])->name('peliculas');
    Route::get('/crear_pelicula', [PeliculasController::class, 'create'])->name('crear_pelicula');
    Route::get('/editar_pelicula/{id}', [PeliculasController::class, 'edit'])->name('editar_pelicula');
    Route::post('store_pelicula' , [PeliculasController::class, 'store'])->name('store_pelicula');
    Route::post('update_pelicula/{id}' , [PeliculasController::class, 'update'])->name('update_pelicula');
    Route::delete('destroy_pelicula/{id}' , [PeliculasController::class, 'destroy'])->name('destroy_pelicula');
    Route::get('/ver_pelicula/{id}', [PeliculasController::class, 'show'])->name('ver_pelicula');
});


//rutas de salas
Route::middleware('auth')->group(function () {
    Route::get('/salas', [SalasController::class, 'index'])->name('salas');
    Route::get('/crear_sala', [SalasController::class, 'create'])->name('crear_sala');
    Route::get('/editar_sala/{id}', [SalasController::class, 'edit'])->name('editar_sala');
    Route::post('store_sala' , [SalasController::class, 'store'])->name('store_sala');
    Route::post('update_sala/{id}' , [SalasController::class, 'update'])->name('update_sala');
    Route::delete('destroy_sala/{id}' , [SalasController::class, 'destroy'])->name('destroy_sala');
});


//Rutas de funciones
Route::middleware('auth')->group(function () {
    Route::get('/funciones', [FuncionesController::class, 'index'])->name('funciones');
    Route::post('/funciones', [FuncionesController::class, 'indexMovie'])->name('indexMovie');
    Route::get('/crear_funcion', [FuncionesController::class, 'create'])->name('crear_funcion');
    Route::get('/editar_funcion/{id}', [FuncionesController::class, 'edit'])->name('editar_funcion');
    Route::post('store_funcion' , [FuncionesController::class, 'store'])->name('store_funcion');
    Route::post('update_funcion/{id}' , [FuncionesController::class, 'update'])->name('update_funcion');
    Route::delete('destroy_funcion/{id}' , [FuncionesController::class, 'destroy'])->name('destroy_funcion');
    Route::get('/pelicula/{id}/funciones/', [FuncionesController::class, 'showFuncionesPorPelicula'])->name('show_funciones_pelicula');
    Route::get('/sala/{id}/funciones/', [FuncionesController::class, 'showFuncionesPorSala'])->name('show_funciones_sala');
});


//Rutas de extras

Route::middleware('auth')->group(function () {
    Route::get('/extras', [ExtrasController::class, 'index'])->name('extras');
    Route::get('/crear_extra', [ExtrasController::class, 'create'])->name('crear_extra');
    Route::get('/editar_extra/{id}', [ExtrasController::class, 'edit'])->name('editar_extra');
    Route::post('store_extra' , [ExtrasController::class, 'store'])->name('store_extra');
    Route::post('update_extra/{id}' , [ExtrasController::class, 'update'])->name('update_extra');
    Route::delete('destroy_extra/{id}' , [ExtrasController::class, 'destroy'])->name('destroy_extra');
});

require __DIR__.'/auth.php';
