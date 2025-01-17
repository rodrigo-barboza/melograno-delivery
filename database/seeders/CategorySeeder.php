<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'chinesas',
                'slug'=> 'chinese',
                'cover' => asset('images/culinaria-chinesa.jpg'),
            ],
            [
                'name'=> 'brasileiras',
                'slug'=> 'brazilian',
                'cover' => asset('images/comida-brasileira.jpg'),
            ],
            [
                'name' => 'pizzas',
                'slug' => 'pizzas',
                'cover' => asset('images/pizzas.jpg'),
            ],
            [
                'name' => 'hambúrgueres',
                'slug' => 'hamburgers',
                'cover' => asset('images/hamburger.webp'),
            ],
            [
                'name' => 'doces e bolos',
                'slug' => 'sweets-and-cakes',
                'cover' => asset('images/doces-bolos.png'),
            ],
            [
                'name'=> 'salgados',
                'slug'=> 'salty',
                'cover' => asset('images/salgados.jpg'),
            ],
            [
                'name' => 'sorvetes',
                'slug'=> 'ice-creams',
                'cover' => asset('images/sorvetes.jpg'),
            ],
            [
                'name'=> 'japonesa',
                'slug'=> 'japanese',
                'cover' => asset('images/culinaria-japonesa.jpg'),
            ],
            [
                'name'=> 'saudável',
                'slug'=> 'healthy',
                'cover' => asset('images/saudavel.jpg'),
            ],
            [
                'name'=> 'bebidas',
                'slug'=> 'drinks',
                'cover' => asset('images/bebidas.webp'),
            ],
        ]);
    }
}
