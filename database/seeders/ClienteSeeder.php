<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'nombre_completo' => 'Federico ejemplo',
                'dni_nif'         => '12345678A',
                'direccion'       => 'Calle Mayor 1, Madrid',
                'telefono'        => '600123456',
                'email'           => 'asdasdas@example.com',
                'es_empresa'      => false,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'nombre_completo' => 'AgroServicios S.L.',
                'dni_nif'         => 'B98765432',
                'direccion'       => 'Av. del Campo 45, Sevilla',
                'telefono'        => '955123789',
                'email'           => 'info@agroservicios.com',
                'es_empresa'      => true,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
