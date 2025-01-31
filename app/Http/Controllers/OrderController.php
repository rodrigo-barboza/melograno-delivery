<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrder;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpFoundation\Response;

final class OrderController
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Orders/Index', [
            'orders' => Order::query()->orderBy('id', 'desc')->paginate(20),
        ]);
    }

    public function store(StoreOrderRequest $request, Order $order, CreateOrder $action): Response
    {
        $action->handle($order, $request->validated('orders'));

        return response(Response::HTTP_CREATED);
    }
}
