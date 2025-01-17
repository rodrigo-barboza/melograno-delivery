<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstablishmentCollection;
use App\Models\Establishment;

class EstablishmentController extends Controller
{
    public function index(): EstablishmentCollection
    {
        return EstablishmentCollection::make(
            Establishment::with([
                'operatingHour' => fn($query) => $query->orderBy('day_of_week'),
                'categories',
            ])->paginate(15),
        );
    }
}
