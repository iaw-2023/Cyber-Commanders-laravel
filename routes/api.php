<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\ExtrasController;
use App\Http\Controllers\FuncionesController;
use App\Http\Controllers\EntradasController;

/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('extras', [ExtrasController::class, 'indexApi']);
Route::get('funciones', [FuncionesController::class, 'indexApi']);
Route::get('pelicula/funciones/{id}', [FuncionesController::class, 'indexMovieApi']);
Route::get('peliculas', [PeliculasController::class, 'indexApi']);
Route::post('storeEntrada', [EntradasController::class, 'addExtra']);
