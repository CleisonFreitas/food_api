<?php

namespace App\Enums;

/**
 * List of models related to RateControl model.
 */
enum RateMorphEnum: string
{
    case ESTABELECIMENTO = 'ESTABELECIMENTO';
    case PRATO = 'PRATO';

    public function description(): string
    {
        return match($this) {
            self::ESTABELECIMENTO => 'estabelecimento',
            self::PRATO => 'prato',
        };
    }

    public static function descriptions(): array
    {
        return array_map(fn($case) => $case->description(), self::cases());
    }
}
