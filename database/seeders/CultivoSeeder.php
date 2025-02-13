<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CultivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cultivos')->insert([
            ['nombre' => 'Trigo', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Maíz', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cebada', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Girasol', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Olivo', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
