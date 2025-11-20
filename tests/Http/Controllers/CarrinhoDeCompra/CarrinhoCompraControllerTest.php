<?php
namespace Tests\Http\Controllers\CarrinhoDeCompra;

use App\Models\CarrinhoCompra;
use App\Models\Cliente;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class CarrinhoCompraControllerTest extends TestCase
{
    /**
     * Testa a função de buscar algum carrinho vinculado
     * ao cliente.
     * 
     * @return void
     */
    #[Test]
    public function show(): void
    {
        $cliente = Cliente::factory()->create();
        CarrinhoCompra::factory()->for($cliente)->Create();
        Sanctum::actingAs($cliente);

        $resposta = $this->getJson('api/v1/carrinho-de-compra');
        $resposta->assertOk();
    }
}