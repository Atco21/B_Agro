<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RendimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rendimientos')->insert([
            [
                'parcela_id' => 1, // Asegúrate de que esta parcela exista
                'c_sembrada' => 100.5,
                'c_recolectada' => 90.0,
                'c_esperada' => 95.0,
                'semillaCostes' => 200.0,
                'fertilizantesCostes' => 150.0,
                'otrosCostes' => 50.0,
                'precio_tonelada' => 500.0,
                'total_vendido' => 45000.0,
                'fecha_inicio' => '2024-03-01',
                'fecha_fin' => '2024-09-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parcela_id' => 2,
                'c_sembrada' => 120.0,
                'c_recolectada' => 110.0,
                'c_esperada' => 115.0,
                'semillaCostes' => 250.0,
                'fertilizantesCostes' => 180.0,
                'otrosCostes' => 60.0,
                'precio_tonelada' => 520.0,
                'total_vendido' => 57200.0,
                'fecha_inicio' => '2024-04-01',
                'fecha_fin' => '2024-10-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
