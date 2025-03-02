<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Carbon;

class OrdenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ordenes')->insert([
            [
                'estado' => 'pendiente',
                'fecha_inicio' => '2024-02-01',
                'fecha_fin' => null,
                'tarea' => 'Aplicación de fertilizante',
                'jefecampo_id' => 1,
                'aplicador_id' => 2,
                'parcela_id' => 1,
                'id_tratamiento' => null,
                'id_maquina' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'estado' => 'encurso',
                'fecha_inicio' => '2024-01-15',
                'fecha_fin' => null,
                'tarea' => 'Siembra de maíz',
                'jefecampo_id' => 1,
                'aplicador_id' => 2,
                'parcela_id' => 2,
                'id_tratamiento' => null,
                'id_maquina' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
