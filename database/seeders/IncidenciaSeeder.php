<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('incidencia')->insert([
            // Orden 9: Incidencia de Personal
            [
                'fecha'       => now(),
                'descripcion' => 'No he podido realizar la orden debido a un imprevisto Personal.',
                'solucion'    => null,
                'estado'      => 'Pendiente',
                'tipo'        => 'Personal',
                'user_id'     => null,
                'orden_id'    => 9,
                'explotacion_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // Orden 10: Incidencia de Stock
            [
                'fecha'       => now(),
                'descripcion' => 'No se pudo ejecutar la orden por falta de Stock de productos.',
                'solucion'    => null,
                'estado'      => 'Pendiente',
                'tipo'        => 'Stock',
                'user_id'     => null,
                'orden_id'    => 10,
                'explotacion_id' => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // Orden 11: Incidencia de máquina
            [
                'fecha'       => now(),
                'descripcion' => 'La máquina asignada se estropeó antes de completar la tarea.',
                'solucion'    => null,
                'estado'      => 'Pendiente',
                'tipo'        => 'Maquina',
                'user_id'     => null,
                'orden_id'    => 11,
                'explotacion_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // Orden 12: Incidencia de Personal
            [
                'fecha'       => now(),
                'descripcion' => 'No he podido completar la orden por motivos de salud.',
                'solucion'    => null,
                'estado'      => 'Pendiente',
                'tipo'        => 'Personal',
                'user_id'     => null,
                'orden_id'    => 12,
                'explotacion_id' => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
