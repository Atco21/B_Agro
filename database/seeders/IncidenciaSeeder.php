<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class IncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('incidencia')->insert([
            [
                'fecha' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'descripcion' => 'Falla en la máquina de producción',
                'solucion' => 'Reemplazo de pieza defectuosa',
                'estado' => 'resuelta',
                'tipo' => 'maquina',
                'user_id' => 1, // Asegúrate de que el usuario 1 existe
                'orden_id' => 1, // Asegúrate de que la orden 1 existe
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'descripcion' => 'Falta de stock de químicos',
                'solucion' => null,
                'estado' => 'pendiente',
                'tipo' => 'stock',
                'user_id' => 2,
                'orden_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha' => Carbon::now()->subDay()->format('Y-m-d'),
                'descripcion' => 'Empleado reportó accidente menor',
                'solucion' => 'Atención médica rápida',
                'estado' => 'resuelta',
                'tipo' => 'personal',
                'user_id' => 3,
                'orden_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
