<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nombre' => 'Juan Pérez',
            'dni' => '12345678A',
            'telefono' => '600123456',
            'email' => 'juan@example.com',
            'fecha_nacimiento' => '1990-05-15',
            'usuario' => 'juanperez',
            'password' => Hash::make('password123'),
            'rol' => 'jefe de campo',
            'explotacion_id' => 1,
        ]);

        User::create([
            'nombre' => 'María López',
            'dni' => '87654321B',
            'telefono' => '601987654',
            'email' => 'maria@example.com',
            'fecha_nacimiento' => '1985-09-20',
            'usuario' => 'marialopez',
            'password' => Hash::make('password123'),
            'rol' => 'aplicador',
            'explotacion_id' => 2,
        ]);

        User::create([
            'nombre' => 'Alfred Comanescu',
            'dni' => '12345678Z',
            'telefono' => '663123456',
            'email' => 'admin@admin.es',
            'fecha_nacimiento' => '2005-06-07',
            'usuario' => 'admin',
            'password' => Hash::make('1234'),
            'rol' => 'admin',
        ]);


    }
}
