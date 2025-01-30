<?php

namespace App\Models\Traits;

trait GeneratesOrderNumber
{
    public static function getNextOrderNumber(string $establishment_id): int
    {
        $last_order = self::where('establishment_id', $establishment_id)
            ->orderBy('number', 'desc')
            ->first();

        return $last_order ? $last_order->number + 1 : 1;
    }

    public static function bootGeneratesOrderNumber(): void
    {
        static::creating(function ($order): void {
            $order->number = self::getNextOrderNumber($order->establishment_id);
        });
    }
}
