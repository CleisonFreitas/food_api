<?php

declare(strict_types=1);

namespace App\Services\Client\Auth;

use App\Models\Client;
use App\Support\Helper;
use Exception;
use Illuminate\Support\Facades\Hash;

class RegisterNewClient
{
    public function __construct(
        private readonly LoginService $loginService
    ) {}
    public function execute(array $data): array
    {
        $senha = data_get($data, 'senha');
        $confirmSenha = data_get($data, 'confirm_senha');

        if ($senha !== $confirmSenha) {
            throw new Exception('O campo confirmar senha está divergente de senha');
        }
        $finalData = [
            'nome' => $data['nome'],
            'email' => $data['email'],
            'senha' => Hash::make($data['senha'])
        ];

        $cliente = Client::create($finalData);
        $tokenData = Helper::registerNewToken($cliente);
        return [
            'message' => 'Cadastro realizado com sucesso!',
            ...$tokenData
        ];
    }
}
