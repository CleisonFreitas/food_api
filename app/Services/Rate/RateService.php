<?php

namespace App\Services\Rate;

use App\Enums\RateMorphEnum;
use App\Models\Estabelecimento;
use App\Models\Prato;

class RateService
{
    public function apply(array $dados, int $clientId): array
    {
        // Map the string to a model class
        $modelClass = $this->resolveModelClass($dados['model_type']);

        $model = $modelClass::findOrFail($dados['model_id']);
        $rate = $dados['nota'];

        $model->avaliacoes()->updateOrCreate(
            ['cliente_id' => $clientId],
            ['nota' => $rate]
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
            RateMorphEnum::ESTABELECIMENTO->description() => Estabelecimento::class,
            RateMorphEnum::PRATO->description() => Prato::class,
            default => throw new \InvalidArgumentException('Objeto informado não avaliável')
        };
    }
}
