<?php

namespace App\Http\Controllers;

use App\Actions\CancelOrder;
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
        $current_page = request()->query('page', 1);
        $per_page = 20;

        return Inertia::render('Orders/Index', [
            'orders' => Order::query()
                ->with('establishment:id,name,cover')
                ->skip(($current_page - 1) * $per_page)
                ->take($per_page)
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy(fn (Order $order) => $order->created_at->format('Y-m-d')),
            'pagination' => [
                'total' => $total_orders = Order::query()->count(),
                'current_page' => $current_page,
                'last_page' => ceil($total_orders / $per_page),
            ],
        ]);
    }

    public function store(StoreOrderRequest $request, Order $order, CreateOrder $action): Response
    {
        $action->handle($order, $request->validated('orders'));

        return response(Response::HTTP_CREATED);
    }

    public function cancel(Order $order, CancelOrder $action): Response
    {
        $action->handle($order, ['cancelation_reason' => 'Cancelado pelo usuário']);

        return response(Response::HTTP_ACCEPTED);
    }
}
