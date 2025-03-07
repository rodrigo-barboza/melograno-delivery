<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests\UpdateCoverRequest;
use App\Models\Establishment;
use Inertia\Response;

final class EstablishmentSettingsController
{
    public function index(): Response
    {
        return inertia('Seller/Settings/Index', [
            'establishment' => Establishment::query()
                ->with(['operatingHour' => fn ($query) => $query->orderBy('day_of_week')])
                ->first(),
        ]);
    }

    public function updateCover(UpdateCoverRequest $rquest): void
    {

    }
}
