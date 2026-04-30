<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideojuegoController;

Route::apiResource('videojuego', VideojuegoController::class);
Route::get('/test', function () {
    return 'API FUNCIONA';
});