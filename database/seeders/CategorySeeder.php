<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = array_map(fn ($category) => [
            'name' => $category->label(),
            'slug' => $category->value,
            'cover' => $category->cover(),
        ], Category::cases());

        DB::table('categories')->insert($categories);
    }
}
