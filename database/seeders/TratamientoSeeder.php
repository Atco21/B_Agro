<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tratamiento 1
        DB::table('tratamientos')->insert([
            'nombre' => 'Fungicida',
            'descripcion' => 'Tratamiento para hongos',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tratamiento 2
        DB::table('tratamientos')->insert([
            'nombre' => 'Insecticida',
            'descripcion' => 'Tratamiento para insectos',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tratamiento 3
        DB::table('tratamientos')->insert([
            'nombre' => 'Herbicida',
            'descripcion' => 'Tratamiento para malas hierbas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tratamiento 4
        DB::table('tratamientos')->insert([
            'nombre' => 'Fertilizante',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
