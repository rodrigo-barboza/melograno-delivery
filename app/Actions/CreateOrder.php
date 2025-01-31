<?php

namespace App\Actions;

use App\Enums\OrderStatusEnum;
use App\Events\NewOrderWasCreated;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateOrder
{
    public function handle(Order $order, array $attributes, bool $dispatchable = true): array
    {
        $orders = [];

        DB::transaction(function () use ($order, $attributes, $dispatchable, &$orders): void {
            foreach ($attributes as $establishment_order) {
                $new_order = $order->create([
                    ...$establishment_order,
                    'user_id' => Auth::user()->id,
                    'status' => OrderStatusEnum::WAINTING->value,
                    'total_items' => $this->calculateTotalItemsPrice($establishment_order['items']),
                ]);

                $orders[] = $new_order;

                NewOrderWasCreated::dispatchIf($dispatchable, $new_order);
            }

            request()->user()->carts()->delete();
        });

        return $orders;
    }

    private function calculateTotalItemsPrice(array $items): int
    {
        return array_reduce($items, function ($carry, $item): float|int {
            return $carry + $item['quantity'] * $item['dish']['price'];
        }, 0);
    }
}
