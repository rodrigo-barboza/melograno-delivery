<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrder;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;

final class OrderController
{
    public function store(StoreOrderRequest $request, Order $order, CreateOrder $action): Response
    {
        $action->handle($order, $request->validated('orders'));

        return response(Response::HTTP_CREATED);
    }
}
