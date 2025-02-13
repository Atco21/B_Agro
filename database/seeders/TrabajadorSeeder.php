<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Hash;

class TrabajadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trabajador::create([
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
        ]);

        Trabajador::create([
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
        ]);
    }
}
