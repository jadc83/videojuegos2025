<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posesion extends Model
{
    /** @use HasFactory<\Database\Factories\PosesionFactory> */
    use HasFactory;
    protected $table = 'posesiones';
}
