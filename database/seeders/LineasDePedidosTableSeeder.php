<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineasDePedidosTableSeeder extends Seeder
{
    /**
     * Ejecutar las semillas de la base de datos.
     */
    public function run(): void
    {
        DB::table('lineas_de_pedidos')->insert([
            [
                'pedido_id' => 1, // Asegúrate de que este pedido exista en la tabla `pedidos`
                'quimico_id' => 1, // Asegúrate de que este químico exista en la tabla `quimicos`
                'cantidad' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pedido_id' => 1,
                'quimico_id' => 2,
                'cantidad' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pedido_id' => 2,
                'quimico_id' => 3,
                'cantidad' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
