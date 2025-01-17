<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperatingHourFactory extends Factory
{
    public function definition(): array
    {
        return [
            'establishment_id' => null,
            'day_of_week' => $this->faker->numberBetween(0, 6),
            'opens_at' => $this->faker->time('H:i', '12:00'),
            'closes_at' => $this->faker->time('H:i', '23:00'),
        ];
    }
}
