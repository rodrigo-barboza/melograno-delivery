<?php

namespace App\Http\Controllers\Seller;

use App\Http\Resources\EstablishmentResource;
use Inertia\Inertia;
use Inertia\Response;

class SellerController
{
    public function index(): Response
    {
        return Inertia::render('Seller/Dashboard/Index', [
            'establishment' => EstablishmentResource::make(
                request()->user()->establishment()->first()
            ),
        ]);
    }
}
