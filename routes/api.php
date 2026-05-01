<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideojuegoController;

// aqui defino donde estan las rutas de las api.
Route::apiResource('videojuego', VideojuegoController::class);

// ruta para eliminar todos los videojuegos de la base de datos
Route::delete('videojuego/delete/all', [VideojuegoController::class, 'deleteAll']);
//la ruta es /delete/all porque si ponia /deleteAll se confundia con el api de buscar por id.....