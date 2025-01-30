<?php

namespace Database\Factories;

use App\Enums\DishesCategoriesEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class DishFactory extends Factory
{
    private static Collection $categories;

    public function definition(): array
    {
        $foods = [
            asset('/images/feijoada.webp'),
            asset('/images/fastfood.jpg'),
        ];

        $drinks = [
            asset('/images/coca.webp'),
            asset('/images/heineken.webp'),
        ];

        $category = $this->getUniqueCategory();

        return [
            'establishment_id' => null,
            'category_id' => $category->id,
            'name' => $this->faker->words($this->faker->numberBetween(1, 4), true),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->randomElement(
                $category->slug === DishesCategoriesEnum::DRINKS->value
                ? $drinks
                : $foods
            ),
            'price' => $this->faker->numberBetween(10, 100),
        ];
    }

    private function getUniqueCategory(): Category
    {
        if (empty(self::$categories)) {
            self::$categories = Category::all();
        }

        if (self::$categories->isEmpty()) {
            return Category::inRandomOrder()->first();
        }

        return self::$categories->pop();
    }
}
