<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AlmacenQuimicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 DB::table('almacen_quimico')->insert([
            [
                'almacen_id' => 1,
                'quimico_id' => 1,
                'unidad' => 'L',
                'stock_minimo' => 20,
                'stock_maximo' => 200,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 2,
                'quimico_id' => 2,
                'unidad' => 'g',
                'stock_minimo' => 70,
                'stock_maximo' => 100,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 3,
                'quimico_id' => 3,
                'unidad' => 'ml',
                'stock_minimo' => 35,
                'stock_maximo' => 60,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
