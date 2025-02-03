<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(string $slug_category): Response
    {
        return Inertia::render('Categories/Index', [
            'dishes' => Dish::whereHas(
                'category',
                fn ($query) => $query->where('slug', $slug_category)
            )->paginate(14),
            'category' => Category::where('slug', $slug_category)->first(),
        ]);
    }
}
