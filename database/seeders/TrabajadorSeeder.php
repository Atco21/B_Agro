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
        // Usuario 1
        User::create([
            'nombre' => 'Juan Pérez',
            'dni' => '12345678A',
            'telefono' => '600123456',
            'email' => 'juan@example.com',
            'fecha_nacimiento' => '1990-05-15',
            'usuario' => 'juanperez',
            'password' => Hash::make('1234'),
            'rol' => 'jefe de campo',
            'explotacion_id' => 1,
        ]);

        // Usuario 2
        User::create([
            'nombre' => 'Maria Martin',
            'dni' => '87654321B',
            'telefono' => '601987654',
            'email' => 'maria@example.com',
            'fecha_nacimiento' => '1985-09-20',
            'usuario' => 'maria',
            'password' => Hash::make('1234'),
            'rol' => 'aplicador',
            'explotacion_id' => 2,
        ]);

        // Usuario 3
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

        // Usuario 4
        User::create([
            'nombre' => 'Carlos Gómez',
            'dni' => '23456789C',
            'telefono' => '602345678',
            'email' => 'carlos@example.com',
            'fecha_nacimiento' => '1992-03-25',
            'usuario' => 'carlosgomez',
            'password' => Hash::make('1234'),
            'rol' => 'aplicador',
            'explotacion_id' => 1,
        ]);

        // Usuario 5
        User::create([
            'nombre' => 'Laura Rodríguez',
            'dni' => '98765432D',
            'telefono' => '603456789',
            'email' => 'laura@example.com',
            'fecha_nacimiento' => '1988-11-10',
            'usuario' => 'laurarodriguez',
            'password' => Hash::make('1234'),
            'rol' => 'jefe de campo',
            'explotacion_id' => 3,
        ]);

        // Usuario 6
        User::create([
            'nombre' => 'Luis García',
            'dni' => '34567890E',
            'telefono' => '604567890',
            'email' => 'luis@example.com',
            'fecha_nacimiento' => '1995-07-30',
            'usuario' => 'luisgarcia',
            'password' => Hash::make('1234'),
            'rol' => 'aplicador',
            'explotacion_id' => 2,
        ]);

        // Usuario 7
        User::create([
            'nombre' => 'Pedro Romero',
            'dni' => '45678901F',
            'telefono' => '605678901',
            'email' => 'pedro@example.com',
            'fecha_nacimiento' => '1993-02-13',
            'usuario' => 'pedro',
            'password' => Hash::make('1234'),
            'rol' => 'aplicador',
            'explotacion_id' => 3,
        ]);
    }
}
