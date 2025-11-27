<?php

namespace Tests\Services\Foods;

use App\Models\Estabelecimento;
use App\Models\Prato;
use App\Services\Food\FoodSearchService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class FoodSearchServiceTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function execute_with_filters(): void
    {
        Prato::factory()->create();
        $pratoParaBuscar = Prato::factory()->create();
        $filters = [
            ['column' => 'id', 'value' => $pratoParaBuscar->id],
            ['column' => 'nome', 'value' => $pratoParaBuscar->nome]
        ];
        $pratoEncontrado = app(FoodSearchService::class)->execute(filters: $filters, orders: []);
        $prato = $pratoEncontrado->items()[0];
        $this->assertEquals($pratoParaBuscar->nome, actual: $prato['nome']);
        $this->assertEquals($pratoParaBuscar->categoria, $prato['categoria']);
        $this->assertEquals($pratoParaBuscar->image, $prato['image']);
    }

    #[Test]
    public function execute_with_orders(): void
    {
        $pratoParaBuscar = Prato::factory()->create();
        $orders = [
            ['column' => 'id', 'order' => 'desc'],
        ];
        $pratoEncontrado = app(FoodSearchService::class)->execute(filters: [], orders: $orders);
        $prato = $pratoEncontrado->items()[0];
        $this->assertEquals($pratoParaBuscar->nome, $prato['nome']);
        $this->assertEquals($pratoParaBuscar->categoria, $prato['categoria']);
        $this->assertEquals($pratoParaBuscar->image, $prato['image']);
    }

    #[Test]
    public function execute_with_search_text(): void
    {
        $estabelecimento = Estabelecimento::factory()->create();
        $prato = Prato::factory()->create([
            'estabelecimento_id' => $estabelecimento->id
        ]);
        $pratoEncontrado = app(FoodSearchService::class)->execute(
            filters: [],
            orders: [],
            search: $estabelecimento->nome
        );
        $dados = $pratoEncontrado->items()[0];
        $this->assertEquals($prato->id, $dados['id']);
        $this->assertEquals($prato->nome, $dados['nome']);
    }

    #[Test]
    public function execute_with_array_search_text(): void
    {
        $pratos = Prato::factory()->count(2)->create();
        $termoDeBusca = implode(",", $pratos->pluck('nome')->toArray());
        $pratosEncontrados = $pratoEncontrado = app(FoodSearchService::class)->execute(
            filters: [],
            orders: [],
            search: $termoDeBusca
        );
        $busca = $pratosEncontrados->items();
        $this->assertTrue($pratos->contains('id',$busca[0]['id']));
        $this->assertTrue($pratos->contains('id',$busca[1]['id']));
    }
}
