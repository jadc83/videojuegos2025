<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Distribuidora;

class DistribuidoraSeeder extends Seeder
{
    public function run(): void
    {
        Distribuidora::factory()->count(10)->create(); // Crea 10 distribuidoras ficticias
    }
}
