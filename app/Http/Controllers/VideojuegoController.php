<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;


class VideojuegoController extends Controller
{
    // muestra una lista de todos los videojuegos en formato JSON

// Devuelve en JSON todos los videojuegos de la base de datos
    public function index()
{
    return response()->json(Videojuego::all());
}

//muestra un videojuego específico por su ID en formato JSON
public function show($id)
{
    $videojuego = Videojuego::find($id); //con find busca el videojuego por su ID, si no lo encuentra devuelve null

    if (!$videojuego) {
        return response()->json([
            "error" => "producte no trobat"
        ], 404); // el error 404 indica que no se a encontrado el id
    }

    return $videojuego;
}

// Crea un nuevo videojuego con los datos dados en el post
public function store(Request $request)
{
    $videojuego = Videojuego::create([
        'nombre' => $request->nombre,
        'genero' => $request->genero,
        'plataforma' => $request->plataforma,
        'fecha_lanzamiento' => $request->fecha_lanzamiento,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'imagen_url' => $request->imagen_url,
    ]);

    return response()->json($videojuego, 201); // el error 201 indica que se a creado un nuevo recurso
}

// Actualiza un videojuego específico por su ID
   public function update(Request $request, $id)
{
    $videojuego = Videojuego::find($id);

    if (!$videojuego) {
        return response()->json([
            "error" => "producte no trobat"
        ], 404); // el error 404 indica que no se a encontrado el id
    }

    $videojuego->update([
        'nombre' => $request->nombre,
        'genero' => $request->genero,
        'plataforma' => $request->plataforma,
        'fecha_lanzamiento' => $request->fecha_lanzamiento,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'imagen_url' => $request->imagen_url,
    ]);

    return response()->json($videojuego);
}

// Elimina un videojuego específico por su ID
public function destroy($id)
{
    $videojuego = Videojuego::find($id);

    if (!$videojuego) {
        return response()->json([
            "error" => "producte no trobat"
        ], 404); // el error 404 indica que no se a encontrado el id
    }

    $videojuego->delete();

    return response()->json([
        "deleted" => "ok"
    ]);
}

// Elimina todos los videojuegos de la base de datos
public function deleteAll()
{
    Videojuego::truncate();

    return response()->json([
        "deleted" => "all ok"
    ]);
}
}
