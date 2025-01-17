<?php

namespace Database\Factories;

use App\Models\Establishment;
use App\Models\EstablishmentCategory;
use App\Models\OperatingHour;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstablishmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'business_registration' => $this->faker->numerify('###########'),
            'phone' => $this->faker->phoneNumber,
            'cep' => $this->faker->postcode,
            'number' => $this->faker->buildingNumber,
            'address' => $this->faker->streetAddress,
            'image' => $this->faker->randomElement([asset('/images/placeholder-a.svg'), asset('/images/placeholder-b.svg')]),
            'cover' => $this->faker->randomElement([asset('/images/placeholder-a.svg'), asset('/images/placeholder-b.svg')]),
            'minimum_order_value' => $this->faker->numberBetween(10, 100),
            'rate' => $this->faker->randomFloat(2, 0, 5),
            'user_id' => User::factory()->create()->id,
            'delivery_average_time_min' => $this->faker->numberBetween(10, 30),
            'delivery_average_time_max' => $this->faker->numberBetween(30, 60),
        ];
    }

    public function withResponsible(): Factory
    {
        return $this->afterCreating(function (Establishment $establishment): void {
            $establishment->user->establishment_id = $establishment->id;
            $establishment->user->save();
        });
    }

    public function withOperatingHours(): Factory
    {
        return $this->afterCreating(function (Establishment $establishment): void {
            OperatingHour::factory()->count($this->faker->numberBetween(2, 7))
                ->create([
                    'establishment_id' => $establishment->id,
                ]);
        });
    }

    public function withCategory(): Factory
    {
        return $this->afterCreating(function (Establishment $establishment): void {
            $category = EstablishmentCategory::factory()->create();
            $establishment->categories()->attach($category->id);
        });
    }
}
