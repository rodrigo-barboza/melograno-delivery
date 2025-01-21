<?php

namespace Database\Factories;

use App\Enums\DishesCategoriesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $random_category = $this->faker->randomElement(DishesCategoriesEnum::cases());

        return [
            'name' => $random_category->name(),
            'slug' => $random_category->value,
            'cover' => $random_category->cover(),
        ];
    }
}
