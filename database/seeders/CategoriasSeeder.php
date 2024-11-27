<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'Conciertos',
                'color' => '#FF5733',
            ],
            [
                'nombre' => 'Conferencias',
                'color' => '#33FF57',
            ],
            [
                'nombre' => 'Festivales',
                'color' => '#3357FF',
            ],
            [
                'nombre' => 'Seminarios',
                'color' => '#F1C40F',
            ],
            [
                'nombre' => 'Exposiciones',
                'color' => '#8E44AD',
            ],
            [
                'nombre' => 'Deportes',
                'color' => '#16A085',
            ],
            [
                'nombre' => 'Teatro',
                'color' => '#E74C3C',
            ],
            [
                'nombre' => 'Cultura',
                'color' => '#9B59B6',
            ],
            [
                'nombre' => 'Arte',
                'color' => '#F39C12',
            ],
            [
                'nombre' => 'Ciencia y Tecnología',
                'color' => '#2ECC71',
            ],
        ]);
    }
}
