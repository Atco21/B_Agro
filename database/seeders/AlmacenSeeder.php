<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplo de IDs de explotaciones existentes (asegúrate de tener estos datos en la tabla 'explotaciones')
        $explotacionIds = DB::table('explotaciones')->pluck('id')->toArray();

        if (empty($explotacionIds)) {
            // Si no hay datos en la tabla explotaciones, muestra un mensaje
            echo "No hay registros en la tabla 'explotaciones'. Agrega datos primero.\n";
            return;
        }

        // Inserción de datos de ejemplo para 'almacenes'
        DB::table('almacenes')->insert([
            [
                'nombre' => 'Almacén Central',
                'id_explotacion' => $explotacionIds[array_rand($explotacionIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Almacén Norte',
                'id_explotacion' => $explotacionIds[array_rand($explotacionIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Almacén Sur',
                'id_explotacion' => $explotacionIds[array_rand($explotacionIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
