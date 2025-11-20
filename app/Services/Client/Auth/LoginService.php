<?php

declare(strict_types=1);

namespace App\Services\Client\Auth;

use App\Exceptions\BusinessRuleException;
use App\Models\Cliente;
use App\Support\Helper;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

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
        $cliente = Cliente::where('email', $email)->first();

        if (!$cliente) {
            throw new BusinessRuleException(
                'Cliente não encontrado! Verifique o email e tente novamente'
            );
        }
        if (!Hash::check($senha, $cliente->senha)) {
            throw new BusinessRuleException(
                'Credenciais incorretas! Tente novamente.',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $tokenData = Helper::registerNewToken($cliente);
        return [
            'message' => 'Login realizado com sucesso!',
            ...$tokenData
        ];
    }
}
