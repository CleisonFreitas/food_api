<?php

namespace Tests\Http\Controllers\Food;


use App\Enums\FoodCategoryEnum;
use App\Models\Client;
use App\Models\Food;
use App\Models\Restaurant;
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
        $client = Client::factory()->create();

        Sanctum::actingAs($client);
        $food = Food::factory()->create();
        $payload = [
            'filters' => [
                ['column' => 'id', 'value' => $food->id],
                ['column' => 'nome', 'value' => $food->nome],
            ],
            'orders' => [['column' => 'id', 'order' => 'asc']],
        ];
        $response = $this->getJson('api/food?' . http_build_query($payload));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                0 => ['id', 'nome', 'categoria', 'image']
            ]
        ]);
    }
    
    #[Test]
    public function store(): void
    {
        $client = Client::factory()->create();
        Sanctum::actingAs($client);
        $restaurant = Restaurant::factory()->create();
        $food = $this->faker->randomElement(Helper::FoodFactory());
        $dataMapped = [
            'nome' => $food['nome'],
            'valor' => $food['valor'],
            'categoria' => FoodCategoryEnum::getFromName($food['categoria']),
            'estabelecimento_id' => $restaurant->id,
            'image' => $food['image'],
        ];
        $response = $this->postJson('api/food', $dataMapped);
        $response->assertCreated();
    }

    #[Test]
    public function show(): void
    {
        $client = Client::factory()->create();

        Sanctum::actingAs($client);
        $food = Food::factory()->create();
        $response = $this->getJson("api/food/$food->id");
        $response->assertOk();
    }

    #[Test]
    public function update(): void
    {
        $client = Client::factory()->create();

        Sanctum::actingAs($client);
        $restaurant = Restaurant::factory()->create();
        $foodModel = Food::factory()->for($restaurant, 'estabelecimento')->create();
        $food = $this->faker->randomElement(Helper::FoodFactory());
        $dataMapped = [
            'nome' => $food['nome'],
            'valor' => $food['valor'],
            'categoria' => FoodCategoryEnum::getFromName($food['categoria']),
            'estabelecimento_id' => $restaurant->id,
            'image' => $food['image'],
        ];
        $response = $this->putJson("api/food/$foodModel->id", $dataMapped);
        $response->assertOk();
    }

    #[Test]
    public function destroy(): void
    {
        $client = Client::factory()->create();

        Sanctum::actingAs($client);
        $food = Food::factory()->create();
        $response = $this->deleteJson("api/food/$food->id");
        $response->assertOk();
        $this->assertNotNull($food->refresh()->deleted_at);
    }
}