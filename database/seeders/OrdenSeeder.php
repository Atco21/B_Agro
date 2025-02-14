<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Carbon;

class OrdenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ordenes')->insert([
            [
                'estado' => 'Pendiente',
                'fecha_inicio' => '2024-02-01',
                'fecha_fin' => null,
                'tarea' => 'Aplicación de fertilizante',
                'id_jefecampo' => 2,
                'aplicador_id' => 3,
                'parcela_id' => 1,
                'id_tratamiento' => 1,
                'id_maquina' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'estado' => 'Completada',
                'fecha_inicio' => '2024-01-15',
                'fecha_fin' => '2024-01-20',
                'tarea' => 'Siembra de maíz',
                'id_jefecampo' => 2,
                'aplicador_id' => 4,
                'parcela_id' => 2,
                'id_tratamiento' => 2,
                'id_maquina' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
