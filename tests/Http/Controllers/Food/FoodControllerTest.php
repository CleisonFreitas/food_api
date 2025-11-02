<?php

namespace Tests\Http\Controllers\Food;


use App\Enums\FoodCategoryEnum;
use App\Models\Cliente;
use App\Models\Estabelecimento;
use App\Models\Prato;
use App\Support\Helper;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class FoodControllerTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function index(): void
    {
        $client = Cliente::factory()->create();

        Sanctum::actingAs($client);
        $food = Prato::factory()->create();
        $payload = [
            'filters' => [
                ['column' => 'id', 'value' => $food->id],
                ['column' => 'nome', 'value' => $food->nome],
            ],
            'orders' => [['column' => 'id', 'order' => 'asc']],
        ];
        $response = $this->getJson('api/prato?' . http_build_query($payload));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                0 => ['id', 'nome', 'categoria', 'image', 'average_rate', 'count_rate']
            ]
        ]);
    }
    
    #[Test]
    public function store(): void
    {
        $client = Cliente::factory()->create();
        Sanctum::actingAs($client);
        $restaurant = Estabelecimento::factory()->create();
        $food = $this->faker->randomElement(Helper::FoodFactory());
        $dataMapped = [
            'nome' => $food['nome'],
            'valor' => $food['valor'],
            'categoria' => FoodCategoryEnum::getFromName($food['categoria']),
            'estabelecimento_id' => $restaurant->id,
            'image' => $food['image'],
        ];
        $response = $this->postJson('api/prato', $dataMapped);
        $response->assertCreated();
    }

    #[Test]
    public function show(): void
    {
        $client = Cliente::factory()->create();

        Sanctum::actingAs($client);
        $prato = Prato::factory()->create();
        $response = $this->getJson("api/prato/$prato->id");
        $response->assertOk();
    }

    #[Test]
    public function update(): void
    {
        $client = Cliente::factory()->create();

        Sanctum::actingAs($client);
        $restaurant = Estabelecimento::factory()->create();
        $prato = Prato::factory()->for($restaurant, 'estabelecimento')->create();
        $food = $this->faker->randomElement(Helper::FoodFactory());
        $dataMapped = [
            'nome' => $food['nome'],
            'valor' => $food['valor'],
            'categoria' => FoodCategoryEnum::getFromName($food['categoria']),
            'estabelecimento_id' => $restaurant->id,
            'image' => $food['image'],
        ];
        $response = $this->putJson("api/prato/$prato->id", $dataMapped);
        $response->assertOk();
    }

    #[Test]
    public function destroy(): void
    {
        $cliente = Cliente::factory()->create();

        Sanctum::actingAs($cliente);
        $prato = Prato::factory()->create();
        $response = $this->deleteJson("api/prato/$prato->id");
        $response->assertOk();
        $this->assertNotNull($prato->refresh()->deleted_at);
    }
}