<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'id_almacen' => 1, // Asumiendo que tienes un almacen con id 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_pedido' => now()->subDays(5),
                'cantidad' => 5,
                'estado' => 'enviado',
                'id_almacen' => 2, // Asumiendo que tienes un almacen con id 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_pedido' => now(),
                'cantidad' => 20,
                'estado' => 'entregado',
                'id_almacen' => 3, // Asumiendo que tienes un almacen con id 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
