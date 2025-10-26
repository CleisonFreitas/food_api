<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Services\Client\Auth\RegisterNewClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class ClientRegisterController
{
    public function __construct(
        private readonly RegisterNewClient $registerNewClientService,
    ) {}

    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'senha' => ['required', 'min:8', 'max:255'],
            'confirm_senha' => ['required', 'confirmed:senha']
        ]);
        $clienteData = $this->registerNewClientService->execute($data);
        return response()->json($clienteData, Response::HTTP_CREATED);
    }
}