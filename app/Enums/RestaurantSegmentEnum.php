<?php

namespace App\Enums;

enum RestaurantSegmentEnum: string
{
    case CAFETERIA = 'CAFETERIA';
    case ITALIAN = 'ITALIAN';
    case JAPANESE = 'JAPANESE';

    public static function toValues(): array
    {
        return [
            self::CAFETERIA->value,
            self::ITALIAN->value,
            self::JAPANESE->value,
        ];
    }
}