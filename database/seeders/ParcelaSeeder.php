<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parcelas')->insert([
            [
                'nombre' => 'Parcela Norte',
                'explotacion_id' => 1,
                'cultivo_id' => 1,
                'tamanyo' => 50.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Parcela Sur',
                'explotacion_id' => 2,
                'cultivo_id' => 2,
                'tamanyo' => 75.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Parcela Este',
                'explotacion_id' => 1,
                'cultivo_id' => 3,
                'tamanyo' => 60.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Parcela Oeste', // Nueva parcela añadida
                'explotacion_id' => 3,
                'cultivo_id' => 4,
                'tamanyo' => 80.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
