<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TratamientoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tratamientos')->insert([
            [
                'nombre' => 'Tratamiento primavera 1',
                'quimico_id' => 1, // Herbicida X200
                'descripcion' => 'Aplicación de herbicida en marzo',
                'dosis' => '2L/ha',
                'tempmax' => '25',
                'tempmin' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Tratamiento fungicida abril',
                'quimico_id' => 2, // Fungicida ProShield
                'descripcion' => 'Prevención de hongos tras lluvias',
                'dosis' => '1.5L/ha',
                'tempmax' => '22',
                'tempmin' => '8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
