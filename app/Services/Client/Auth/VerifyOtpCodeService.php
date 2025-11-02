<?php

declare(strict_types=1);

namespace App\Services\Client\Auth;

use App\Models\ClienteOTP;
use Exception;

class VerifyOtpCodeService
{
    public function execute(string $code): void
    {
        $optCode = ClienteOTP::whereCodigo($code)
            ->whereDate('ativo_ate', '>=', now()
        )->first();

        if(!$optCode) {
            throw new Exception(
                'Código informado inválido! Gere um novo código e tente novamente'
            );
        }

        $optCode->ativo_ate = now();
        $optCode->save();
        $optCode->refresh();
    }
}
