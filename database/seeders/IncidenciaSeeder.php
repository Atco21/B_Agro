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
            [
                'fecha'          => now(),
                'descripcion'    => 'Retraso por condiciones meteorológicas adversas.',
                'solucion'       => null,
                'estado'         => 'Pendiente',
                'tipo'           => 'Personal',
                'user_id'        => null,
                'orden_id'       => 6,
                'explotacion_id' => 1, // coincidente con la orden pausada
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
