<?php

declare(strict_types=1);

namespace App\Services\Client\Auth;

use App\Models\Cliente;
use Exception;

class LogoutService
{
    public function execute(Cliente $client): void
    {
        $client->tokens()->delete();

        $tokensAtivos = $client->tokens();

        if ($tokensAtivos->count()) {
            throw new Exception('Erro ao realizar logout');
        }
    }
}
