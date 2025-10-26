<?php

declare(strict_types=1);

namespace App\Services\Client\Auth;

use App\Models\Client;
use App\Support\Helper;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginService
{
    /**
     * Deve validar o login do cliente e criar um token.
     * 
     * @param array $dados
     *
     * @return array
     */
    public function execute(array $dados): array
    {
        $email = data_get($dados, 'email');
        $senha = data_get($dados, 'senha');
        $cliente = Client::where('email', $email)->first();
        if (!$cliente || Hash::check($senha, $cliente->senha)) {
            throw new Exception('Credenciais incorretas! Tente novamente.');
        }

        $tokenData = Helper::registerNewToken($cliente);
        return [
            'message' => 'Login realizado com sucesso!',
            ...$tokenData
        ];
    }
}
