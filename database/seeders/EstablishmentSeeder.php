<?php

namespace Database\Seeders;

use App\Models\Establishment;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    public function run(): void
    {
        Establishment::factory()
            ->count(50)
            ->withCategory()
            ->withOperatingHours()
            ->withDishes(15)
            ->create();
    }
}
