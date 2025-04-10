<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'cover' => 'https://avatar.oxro.io/avatar.svg?name='.fake()->name(),
            'remember_token' => Str::random(10),
            'establishment_id' => null,
            'provider' => null,
            'role' => 'consumer',
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }

    public function seller(): self
    {
        return $this->state(fn (array $attributes): array => [
            'role' => 'seller',
        ]);
    }
}
