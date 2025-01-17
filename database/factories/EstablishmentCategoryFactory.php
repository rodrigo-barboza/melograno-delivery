<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EstablishmentCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['restaurante', 'bar', 'pizzaria', 'lanchonete', 'hamburgueria']),
            'slug' => $this->faker->randomElement(['restaurant', 'bar', 'pizzeria', 'snack_bar', 'burger_joint']),
        ];
    }
}
