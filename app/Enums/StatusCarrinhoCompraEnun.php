<?php

namespace App\Enums;

enum StatusCarrinhoCompraEnun: string
{
    case PENDENTE = 'PENDENTE';
    case FINALIZADO = 'FINALIZADO';

    public function descricao(): string
    {
        return match ($this) {
            self::PENDENTE => 'Pendente',
            self::FINALIZADO => 'Finalizado'
        };
    }
}
