<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::get('api/extras', [ExtrasController::class, 'indexApi']);
Route::get('api/funciones', [FuncionesController::class, 'indexApi']);
Route::get('api/pelicula/funciones/{id}', [FuncionesController::class, 'indexMovieApi']);
Route::get('api/peliculas', [PeliculasController::class, 'indexApi']);
Route::post('api/storeEntrada', [EntradasController::class, 'addExtra']);
