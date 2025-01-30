<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use Illuminate\Http\Resources\Json\ResourceCollection;
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
