<?php

namespace App\Models\Traits;

trait CalculateTotalPrice
{
    public static function bootCalculateTotalPrice(): void
    {
        static::creating(function ($order): void {
            $order->total = $order->total_items + $order->delivery_tax;
        });
    }
}
