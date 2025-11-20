<?php
namespace App\Http\Controllers;

use App\Enums\StatusCarrinhoCompraEnun;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;

final class CarrinhoCompraController
{
    public function show(): JsonResponse
    {
        /** @var Cliente $cliente */
        $cliente = auth()->guard('cliente')->user();
        $carrinho = $cliente
            ->carrinhosDeCompras()
            ->where('status', StatusCarrinhoCompraEnun::PENDENTE)
            ->first();
        return response()->json($carrinho);
    }
}