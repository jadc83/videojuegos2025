<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posesion extends Model
{
    /** @use HasFactory<\Database\Factories\PosesionFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $table = 'posesiones';
}
