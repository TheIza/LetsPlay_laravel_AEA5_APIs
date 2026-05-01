<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// es el modelo que pido al hacer el post y otros para cada juego
class Videojuego extends Model
{
  protected $fillable = [
    'nombre',
    'genero',
    'plataforma',
    'fecha_lanzamiento',
    'precio',
    'stock',
    'imagen_url'
];

   
}
