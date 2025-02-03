<?php

namespace App\Actions;

use App\Enums\OrderStatusEnum;
use App\Events\AnOrderWasCanceled;
use App\Events\NewOrderWasCreated;
use App\Models\Order;
use DomainException;
use Illuminate\Support\Facades\DB;

class CancelOrder
{
    public function handle(Order $order, array $attributes): void
    {
        if (! in_array($order->status, OrderStatusEnum::cancelableStatus())) {
            throw new DomainException('O pedido não pode ser cancelado');
        }

        DB::transaction(function () use ($order, $attributes): void {
            $order->update([
                'status' => OrderStatusEnum::CANCELED->value,
                'cancelation_reason' => $attributes['cancelation_reason']
            ]);

            AnOrderWasCanceled::dispatch($order);
        });
    }
}
