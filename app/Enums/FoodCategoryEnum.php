<?php

namespace App\Enums;

enum FoodCategoryEnum: string
{
    case PIZZA = 'PIZZA';
    case LANCHES = 'LANCHES';
    case ACOMPANHAMENTOS = 'ACOMPANHAMENTOS';
    case PRATOS = 'PRATOS';
    case MASSAS = 'MASSAS';
    case SALADAS = 'SALADAS';
    case SOPAS = 'SOPAS';
    case ENTRADAS = 'ENTRADAS';
    case SALGADOS = 'SALGADOS';
    case SOBREMESAS = 'SOBREMESAS';
    case BEBIDAS = 'BEBIDAS';
    case CHURRASCO = 'CHURRASCO';

    public function description(): string
    {
        return match ($this) {
            self::PIZZA => 'Pizza',
            self::LANCHES => 'Lanches',
            self::ACOMPANHAMENTOS => 'Acompanhamentos',
            self::PRATOS => 'Pratos',
            self::MASSAS => 'Massas',
            self::SALADAS => 'Saladas',
            self::SOPAS => 'Sopas',
            self::ENTRADAS => 'Entradas',
            self::SALGADOS => 'Salgados',
            self::SOBREMESAS => 'Sobremesas',
            self::BEBIDAS => 'Bebidas',
            self::CHURRASCO => 'Churrasco',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getFromName(string $name): ?self
    {
        foreach (self::cases() as $case) {
            if (strcasecmp($case->description(), $name) === 0) {
                return $case;
            }
        }

        return null;
    }
}
