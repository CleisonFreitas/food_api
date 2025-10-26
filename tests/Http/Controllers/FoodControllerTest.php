<?php

namespace Tests\Http\Controllers;

use App\Enums\FoodCategoryEnum;
use App\Models\Food;
use App\Models\Restaurant;
use App\Support\Helper;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class FoodControllerTest extends TestCase
{
    #[Test]
    public function index(): void
    {
        $response = $this->getJson('api/food');
        $response->assertOk();
    }

    #[Test]
    public function store(): void
    {
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
        $food = Food::factory()->create();
        $response = $this->getJson("api/food/$food->id");
        $response->assertOk();
    }

    #[Test]
    public function update(): void
    {
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
        $food = Food::factory()->create();
        $response = $this->deleteJson("api/food/$food->id");
        $response->assertOk();
        $this->assertNotNull($food->refresh()->deleted_at);
    }
}