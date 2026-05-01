<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideojuegoController;

Route::apiResource('videojuego', VideojuegoController::class);

Route::delete('videojuego/delete/all', [VideojuegoController::class, 'deleteAll']);