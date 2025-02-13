<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplo de datos para la tabla 'pedidos'
        DB::table('pedidos')->insert([
            [
                'fecha_pedido' => now()->subDays(2),
                'cantidad' => 10,
                'estado' => 'pendiente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_pedido' => now()->subDays(5),
                'cantidad' => 5,
                'estado' => 'enviado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_pedido' => now(),
                'cantidad' => 20,
                'estado' => 'entregado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
