<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    protected $fillable = [
    'nombre',
    'genero',
    'precio',
    'stock',
    'imagen_url'
];

   
}
