<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlmacenQuimicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('almacen_quimico')->insert([
            [
                'id_almacen' => 1,
                'id_quimico' => 1,
                'cantidad' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_almacen' => 1,
                'id_quimico' => 2,
                'cantidad' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_almacen' => 2,
                'id_quimico' => 3,
                'cantidad' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
