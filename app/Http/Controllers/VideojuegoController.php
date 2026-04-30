<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;


class VideojuegoController extends Controller
{
    // muestra una lista de todos los videojuegos en formato JSON


    public function index()
{
    return response()->json(Videojuego::all());
}

//muestra un videojuego específico por su ID en formato JSON
public function show($id)
{
    $videojuego = Videojuego::find($id);

    if (!$videojuego) {
        return response()->json([
            "error" => "producte no trobat"
        ], 404);
    }

    return $videojuego;
}

public function store(Request $request)
{
    $videojuego = Videojuego::create([
        'nombre' => $request->nombre,
        'genero' => $request->genero,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'imagen_url' => $request->imagen_url,
    ]);

    return response()->json($videojuego, 201);
}

   
}
