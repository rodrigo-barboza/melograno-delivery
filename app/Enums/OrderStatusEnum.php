<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case WAINTING = 'waiting';
    case IN_PREPARATION = 'in_preparation';
    case AVAILABLE_FOR_PICKUP = 'available_for_pickup';
    case DELIVERING = 'delivering';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';

    public static function values(): array
    {
        return [
            self::WAINTING->value,
            self::IN_PREPARATION->value,
            self::AVAILABLE_FOR_PICKUP->value,
            self::DELIVERING->value,
            self::COMPLETED->value,
            self::CANCELED->value,
        ];
    }

    public static function cancelableStatus(): array
    {
        return [
            self::WAINTING->value,
            self::IN_PREPARATION->value,
        ];
    }
}
