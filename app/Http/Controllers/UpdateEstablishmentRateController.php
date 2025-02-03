<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstablishmentRate;
use App\Models\Establishment;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

final class UpdateEstablishmentRateController
{
    public function __invoke(
        StoreEstablishmentRate $request,
        Establishment $establishment,
        Order $order
    ): JsonResponse {
        $order->update(['rate' => $request->rate]);
        $evaluated_orders = $establishment->whereNotNull('rate')->count() + 1;
        $total_rate = $establishment->sum('rate') + $request->rate;
        $establishment->update(['rate' => number_format($total_rate / $evaluated_orders, 2)]);

        return response()->json([
            'message' => 'Avaliação realizada com sucesso',
        ]);
    }
}
