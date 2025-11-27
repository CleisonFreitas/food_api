<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PratoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'valor' => $this->valor,
            'categoria' => $this->categoria,
            'image' => storage_path('app/public/'. $this->image),
            'estabelecimento_id' => $this->estabelecimento_id,
            'average_rate' => $this->average_rate,
            'count_rate' => $this->count_rate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
