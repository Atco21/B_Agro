<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ExploSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('explotaciones')->insert([
            [
                'nombre' => 'Finca Los Olivos',
                'direccion' => 'Carretera Nacional 123, Km 45',
                'localidad' => 'Sevilla',
                'tamanyo' => 150.75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Granja El Encinar',
                'direccion' => 'Calle Mayor 12',
                'localidad' => 'Madrid',
                'tamanyo' => 200.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Hacienda La Esperanza',
                'direccion' => 'Camino de la Vega s/n',
                'localidad' => 'Córdoba',
                'tamanyo' => 300.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
