<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideojuegoController;
use App\Models\Videojuego;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('videojuegos', VideojuegoController::class);
Route::get('/videojuegos/{id}', [VideojuegoController::class, 'show']);
Route::post('/videojuegos', [VideojuegoController::class, 'store']);