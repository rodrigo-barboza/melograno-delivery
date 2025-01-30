<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstablishmentCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('establishment_categories')->insert([
            [
                'name' => 'restaurante',
                'slug' => 'restaurant',
            ],
            [
                'name' => 'bar',
                'slug' => 'bar',
            ],
            [
                'name' => 'pizzaria',
                'slug' => 'pizzeria',
            ],
            [
                'name' => 'lanchonete',
                'slug' => 'snack_bar',
            ],
            [
                'name' => 'hamburgueria',
                'slug' => 'burger_joint',
            ],
        ]);
    }
}
