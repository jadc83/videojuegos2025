<?php

namespace Database\Factories;

use App\Models\Distribuidora;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistribuidoraFactory extends Factory
{
    protected $model = Distribuidora::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company, // Nombre de empresa ficticia
            'deleted_at' => null, // Para evitar soft deletes en la generación inicial
        ];
    }
}
