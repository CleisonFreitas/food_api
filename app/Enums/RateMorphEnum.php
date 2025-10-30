<?php

namespace App\Enums;

/**
 * List of models related to RateControl model.
 */
enum RateMorphEnum: string
{
    case RESTAURANT = 'RESTAURANT';
    case FOOD = 'FOOD';

    public function description(): string
    {
        return match($this) {
            self::RESTAURANT => 'restaurant',
            self::FOOD => 'food',
        };
    }

    public static function descriptions(): array
    {
        return array_map(fn($case) => $case->description(), self::cases());
    }
}
