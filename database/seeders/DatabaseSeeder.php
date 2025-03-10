<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            ExploSeeder::class,
            CultivoSeeder::class,
            ParcelaSeeder::class,
            TrabajadorSeeder::class,
            QuimicoSeeder::class,
            AlmacenSeeder::class,
            AlmacenQuimicoSeeder::class,
            PedidosTableSeeder::class,
            LineasDePedidosTableSeeder::class, 
            MaquinaSeeder::class,
            OrdenSeeder::class,
        ]);
    }
}
