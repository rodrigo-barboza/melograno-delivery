<?php

namespace App\Actions;

use App\Enums\PaymentStatusEnum;
use App\Events\NewOrderWasCreated;
use App\Models\Order;
use DB;
use Illuminate\Database\Eloquent\Collection;

class MarkOrdersAsPaid
{
    public function handle(Collection $orders): void
    {
        $orders->each(function (Order $order): void {
            DB::transaction(function () use ($order): void {
                $order->lockForUpdate();

                if ($order->payment_status === PaymentStatusEnum::UNPAID->value) {
                    $order->markAsPaid();
                    NewOrderWasCreated::dispatch($order);
                }
            });
        });
    }
}
