<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trabajadores')->insert([
            [
                'nombre_completo' => 'Juan Pérez',
                'dni' => '12345678A',
                'telefono' => '600123456',
                'email' => 'juan.perez@example.com',
                'fecha_nacimiento' => '1985-06-15',
                'usuario' => 'juanperez',
                'password' => Hash::make('password123'),
                'rol' => 'jefe de campo',
                'imagen' => null,
                'explotacion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre_completo' => 'María López',
                'dni' => '87654321B',
                'telefono' => '600654321',
                'email' => 'maria.lopez@example.com',
                'fecha_nacimiento' => '1990-08-25',
                'usuario' => 'marialopez',
                'password' => Hash::make('password123'),
                'rol' => 'trabajador',
                'imagen' => null,
                'explotacion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
