<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EstablishmentCategoryFactory extends Factory
{
    public function definition(): array
    {
        $category = $this->faker->randomElement([
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
                'slug' => 'snack-bar',
            ],
            [
                'name' => 'hamburgueria',
                'slug' => 'burger-joint',
            ],
        ]);

        return [
            'name' => $category['name'],
            'slug' => $category['slug'],
        ];
    }
}
