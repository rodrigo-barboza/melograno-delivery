<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class SearchEstablishmentController
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'establishments' => Establishment::take(5)
                ->filterByName($request->query('search'))
                ->get(['id', 'name']),
        ]);
    }
}
