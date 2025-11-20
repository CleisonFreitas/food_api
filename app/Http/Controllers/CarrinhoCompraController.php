<?php
namespace App\Http\Controllers;

use App\Enums\StatusCarrinhoCompraEnun;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class CarrinhoCompraController
{
    public function show(): JsonResponse
    {
        /** @var Cliente */
        $cliente = Auth::user();
        $carrinho = $cliente
            ->carrinhosDeCompras()
            ->where('status', StatusCarrinhoCompraEnun::PENDENTE)
            ->first();
        return response()->json($carrinho);
    }
}