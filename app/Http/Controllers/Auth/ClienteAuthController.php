<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Models\Client;
use App\Services\Client\Auth\EmailRecoveryService;
use App\Services\Client\Auth\LoginService;
use App\Services\Client\Auth\LogoutService;
use App\Services\Client\Auth\VerifyOtpCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

final readonly class ClienteAuthController
{
    public function __construct(
        private readonly LoginService $loginService,
        private readonly LogoutService $logoutService,
        private readonly EmailRecoveryService $emailRecoveryService,
        private readonly VerifyOtpCodeService $verifyOtpCodeService,
    ) {}

    public function login(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required', 'string']
        ]);
        $token = $this->loginService->execute($dados);
        return response()->json($token);
    }

    public function logout(): JsonResponse
    {
        /** @var Client */
        $client = auth()->guard('client')->user();
        $this->logoutService->execute($client);

        return response()->json($client);
    }

    public function sendEmailToRecoveryPassword(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => ['required', Rule::exists(Client::class, 'email')]
        ], ['email.exists' => 'e-mail não encontrado!']);
        $this->emailRecoveryService->execute(data_get($dados, 'email'));
        return response()->json();
    }

    public function checkingOtpCodeRecovery(Request $request): JsonResponse
    {
        $data = $request->validate([
            'codigo_otp' => ['required', 'string', 'size:4']
        ]);
        /** @var Client */
        $this->verifyOtpCodeService->execute($data['codigo_otp']);
        return response()->json();
    }
}
