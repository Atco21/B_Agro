<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuimicoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('quimico')->insert([
            [
                'nombre' => 'X-150',
                'descripcion' => 'Control de malas hierbas anuales',
                'tipo' => 'Herbicida',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => '2X90',
                'descripcion' => 'Prevención de hongos en cultivos húmedos',
                'tipo' => 'Fungicida',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Z30',
                'descripcion' => 'Eliminación de plagas comunes',
                'tipo' => 'Insecticida',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
