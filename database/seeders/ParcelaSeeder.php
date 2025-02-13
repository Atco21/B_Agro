<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                'explotacion_id' => 1, // Asegúrate de que esta explotación exista
                'cultivo_id' => 1, // Asegúrate de que este cultivo exista
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
        ]);
    }
}
