<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuimicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quimicos')->insert([
            [
                'nombre' => 'Pesticida A',
                'tipo' => 1, // Ejemplo de tipo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Fungicida B',
                'tipo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Herbicida C',
                'tipo' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
