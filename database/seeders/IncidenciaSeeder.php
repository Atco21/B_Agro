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
            // Orden 9: Incidencia de personal
            [
                'fecha'       => now(),
                'descripcion' => 'No he podido realizar la orden debido a un imprevisto personal.',
                'solucion'    => null,
                'estado'      => 'pendiente',
                'tipo'        => 'personal',
                'user_id'     => null,
                'orden_id'    => 9,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // Orden 10: Incidencia de stock
            [
                'fecha'       => now(),
                'descripcion' => 'No se pudo ejecutar la orden por falta de stock de productos.',
                'solucion'    => null,
                'estado'      => 'pendiente',
                'tipo'        => 'stock',
                'user_id'     => null,
                'orden_id'    => 10,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // Orden 11: Incidencia de máquina
            [
                'fecha'       => now(),
                'descripcion' => 'La máquina asignada se estropeó antes de completar la tarea.',
                'solucion'    => null,
                'estado'      => 'pendiente',
                'tipo'        => 'maquina',
                'user_id'     => null,
                'orden_id'    => 11,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            // Orden 12: Incidencia de personal
            [
                'fecha'       => now(),
                'descripcion' => 'No he podido completar la orden por motivos de salud.',
                'solucion'    => null,
                'estado'      => 'pendiente',
                'tipo'        => 'personal',
                'user_id'     => null,
                'orden_id'    => 12,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
