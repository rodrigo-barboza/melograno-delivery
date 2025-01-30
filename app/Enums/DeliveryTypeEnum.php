<?php

namespace App\Enums;

enum DeliveryTypeEnum: string
{
    case PICKUP = 'pickup';
    case DELIVERY = 'delivery';

    public static function values(): array
    {
        return [
            self::PICKUP->value,
            self::DELIVERY->value,
        ];
    }
}
