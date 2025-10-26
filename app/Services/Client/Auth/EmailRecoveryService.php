<?php

declare(strict_types=1);

namespace App\Services\Client\Auth;

use App\Models\Client;
use App\Models\ClientOTP;
use Exception;

class EmailRecoveryService
{
    public function execute(string $email): void
    {
        $client = Client::whereEmail($email)->first();

        if (!$client) {
            throw new Exception('Nenhum cliente associado ao e-mail foi encontrado!');
        }

        // TODO: Implement e-mail recovery;
        ClientOTP::create([
            'cliente_id' => $client->id,
            'codigo' => random_int(1000, 9999),
            'ativo_ate' => now()->addMinutes(2),
        ]);
    }
}
