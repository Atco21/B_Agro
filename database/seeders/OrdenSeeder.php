<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ordenes')->insert([
            // Órdenes Pendientes (aplicador_id1 en [2,4,6])
            [
                'estado' => 'Pendiente',
                'fecha_inicio' => '2024-02-01',
                'fecha_fin' => null,
                'tarea' => 'Aplicación de fertilizante',
                'jefecampo_id' => 1,
                'aplicador_id1' => 2,
                'parcela_id' => 1,
                'id_tratamiento' => 1,
                'id_maquina' => null,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'estado' => 'Pendiente',
                'fecha_inicio' => '2024-02-10',
                'fecha_fin' => null,
                'tarea' => 'Riego de campo',
                'jefecampo_id' => 2,
                'aplicador_id1' => 4,
                'parcela_id' => 2,
                'id_tratamiento' => 1,
                'id_maquina' => 1,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'estado' => 'Pendiente',
                'fecha_inicio' => '2024-02-20',
                'fecha_fin' => null,
                'tarea' => 'Aplicación de herbicida',
                'jefecampo_id' => 1,
                'aplicador_id1' => 6,
                'parcela_id' => 4,
                'id_tratamiento' => 2,
                'id_maquina' => 2,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Órdenes En curso (aplicador_id1 en [2,4,6])
            [
                'estado' => 'En curso',
                'fecha_inicio' => '2024-01-12',
                'fecha_fin' => null,
                'tarea' => 'Cosecha de maíz',
                'jefecampo_id' => 1,
                'aplicador_id1' => 2,
                'parcela_id' => 2,
                'id_tratamiento' => 1,
                'id_maquina' => 2,
                'explotacion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'estado' => 'En curso',
                'fecha_inicio' => '2024-01-22',
                'fecha_fin' => null,
                'tarea' => 'Cosecha de girasol',
                'jefecampo_id' => 2,
                'aplicador_id1' => 4,
                'parcela_id' => 4,
                'id_tratamiento' => 1,
                'id_maquina' => 2,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Órdenes Pausadas (aplicador_id1 en [2,4,6])
            [
                'estado' => 'Pausada',
                'fecha_inicio' => '2024-01-20',
                'fecha_fin' => null,
                'tarea' => 'Podado de árboles',
                'jefecampo_id' => 1,
                'aplicador_id1' => 6,
                'parcela_id' => 4,
                'id_tratamiento' => 1,
                'id_maquina' => null,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'estado' => 'Pausada',
                'fecha_inicio' => '2024-01-20',
                'fecha_fin' => null,
                'tarea' => 'Cortar maleza',
                'jefecampo_id' => 1,
                'aplicador_id1' => 4,
                'parcela_id' => 2,
                'id_tratamiento' => 1,
                'id_maquina' => 2,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Órdenes Completadas (aplicador_id1 en [2,4,6])
            [
                'estado' => 'Completada',
                'fecha_inicio' => '2023-12-10',
                'fecha_fin' => '2023-12-15',
                'tarea' => 'Riego por aspersión',
                'jefecampo_id' => 2,
                'aplicador_id1' => 4,
                'parcela_id' => 2,
                'id_tratamiento' => 1,
                'id_maquina' => null,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'estado' => 'Completada',
                'fecha_inicio' => '2024-01-06',
                'fecha_fin' => '2024-01-07',
                'tarea' => 'Aplicación de fertilizante',
                'jefecampo_id' => 1,
                'aplicador_id1' => 2,
                'parcela_id' => 1,
                'id_tratamiento' => 1,
                'id_maquina' => null,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
