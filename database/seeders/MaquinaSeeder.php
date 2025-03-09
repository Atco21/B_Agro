<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MaquinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('maquina')->insert([
            [
                'explotacion_id' => 1,
                'nombre' => 'Tractor John Deere',
                'matricula' => 'ABC-123',
                'capacidad' => 500.5,
                'estado' => 1,
                'imagen' => 'imagenes/tractor1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'explotacion_id' => 2,
                'nombre' => 'Cosechadora New Holland',
                'matricula' => 'XYZ-789',
                'capacidad' => 750.0,
                'estado' => 1,
                'imagen' => 'imagenes/cosechadora.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'explotacion_id' => 3,
                'nombre' => 'Remolque agrícola',
                'matricula' => 'DEF-456',
                'capacidad' => 1200.0,
                'estado' => 0,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
