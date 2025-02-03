<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use App\Models\EstablishmentCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class EstablishmentController extends Controller
{
    public function index(): ResourceCollection
    {
        return EstablishmentResource::collection(
            Establishment::with(['categories'])->paginate(15),
        );
    }

    public function byCategory(string $slug_category): Response
    {
        return Inertia::render('Establishment/Index', [
            'establishments' => EstablishmentResource::collection(
                Establishment::whereHas('categories', fn($q) => $q->where('slug', $slug_category))
                    ->with('categories')
                    ->get(),
            ),
        ]);
    }

    public function show(Establishment $establishment): Response
    {
        $establishment->load([
            'operatingHour' => fn ($query) => $query->orderBy('day_of_week'),
            'dishes' => fn ($query) => $query->with('category'),
            'categories',
        ]);

        return Inertia::render('Establishment/Show', [
            'establishment' => EstablishmentResource::make($establishment),
        ]);
    }
}
