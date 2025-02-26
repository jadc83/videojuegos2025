<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    /** @use HasFactory<\Database\Factories\VideojuegoFactory> */
    use HasFactory;

    protected $fillable = ['titulo', 'salida', 'desarrolladora_id'];

    public function desarrolladora()
    {
        return $this->belongsTo(Desarrolladora::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'posesiones', 'videojuego_id', 'user_id');
    }
}
