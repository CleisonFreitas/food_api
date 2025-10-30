<?php

namespace App\Services\Rate;

use App\Enums\RateMorphEnum;
use App\Models\Food;
use App\Models\Restaurant;

class RateService
{
    public function apply(array $dados, int $clientId): array
    {
        // Map the string to a model class
        $modelClass = $this->resolveModelClass($dados['model_type']);

        $model = $modelClass::findOrFail($dados['model_id']);
        $rate = $dados['rate'];

        $model->rates()->updateOrCreate(
            ['client_id' => $clientId],
            ['rate' => $rate]
        );
        return [
            'message' => 'Rate created successfully.',
            'average_rate' => $model->average_rate,
            'data' => $rate,
        ];
    }

    private function resolveModelClass(string $type): string
    {
        return match ($type) {
            RateMorphEnum::RESTAURANT->description() => Restaurant::class,
            RateMorphEnum::FOOD->description() => Food::class,
            default => throw new \InvalidArgumentException('Objeto informado não avaliável')
        };
    }
}
