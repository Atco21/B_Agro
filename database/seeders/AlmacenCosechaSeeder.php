<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AlmacenCosechaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('almacen_cosecha')->insert([
            [
                'almacen_id' => 1,
                'cultivo_id' => 1,
                'unidad' => 'kg',
                'stock' => '150',
                'precioPorUnidad' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 1,
                'cultivo_id' => 2,
                'unidad' => 'kg',
                'stock' => '710',
                'precioPorUnidad' => 12.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 1,
                'cultivo_id' => 3,
                'unidad' => 'kg',
                'stock' => '700',
                'precioPorUnidad' => 10.75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 1,
                'cultivo_id' => 4,
                'unidad' => 'kg',
                'stock' => '765',
                'precioPorUnidad' => 9.60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 1,
                'cultivo_id' => 5,
                'unidad' => 'kg',
                'stock' => '450',
                'precioPorUnidad' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'almacen_id' => 2,
                'cultivo_id' => 1,
                'unidad' => 'kg',
                'stock' => '600',
                'precioPorUnidad' => 14.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 2,
                'cultivo_id' => 2,
                'unidad' => 'kg',
                'stock' => '400',
                'precioPorUnidad' => 11.25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 2,
                'cultivo_id' => 3,
                'unidad' => 'kg',
                'stock' => '200',
                'precioPorUnidad' => 9.90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 2,
                'cultivo_id' => 4,
                'unidad' => 'kg',
                'stock' => '900',
                'precioPorUnidad' => 8.70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 2,
                'cultivo_id' => 5,
                'unidad' => 'kg',
                'stock' => '300',
                'precioPorUnidad' => 18.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'almacen_id' => 3,
                'cultivo_id' => 1,
                'unidad' => 'kg',
                'stock' => '200',
                'precioPorUnidad' => 13.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 3,
                'cultivo_id' => 2,
                'unidad' => 'kg',
                'stock' => '150',
                'precioPorUnidad' => 10.80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 3,
                'cultivo_id' => 3,
                'unidad' => 'kg',
                'stock' => '300',
                'precioPorUnidad' => 9.40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 3,
                'cultivo_id' => 4,
                'unidad' => 'kg',
                'stock' => '900',
                'precioPorUnidad' => 8.30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'almacen_id' => 3,
                'cultivo_id' => 5,
                'unidad' => 'kg',
                'stock' => '470',
                'precioPorUnidad' => 17.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
