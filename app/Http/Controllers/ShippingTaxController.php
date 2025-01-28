<?php

namespace App\Http\Controllers;

use App\Http\Services\GoogleMapsService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShippingTaxController extends Controller
{
    public const RATE_PER_KM = 2;

    public function calculate(GoogleMapsService $google_maps_service): JsonResponse
    {
        $distance = $google_maps_service->get(...request()->only(['origin', 'destination']))
            ->distance();

        if (! $distance) {
            return response()->json([
                'error' => 'Unable to calculate distance'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['shippingCost' => ($distance / 1000) * self::RATE_PER_KM]);
    }
}
