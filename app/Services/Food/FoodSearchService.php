<?php

declare(strict_types=1);

namespace App\Services\Food;

use App\Facades\FilterableFacade;
use App\Models\Prato;
use Illuminate\Pagination\LengthAwarePaginator;

class FoodSearchService
{
    public function execute(
        array $filters,
        array $orders,
        int $limite = 10,
        string $search = '',
    ): LengthAwarePaginator
    {
        $query = FilterableFacade::search(Prato::query(), [
            'filters' => $filters,
            'orders' => $orders
        ]);
        if (!empty($search)) {
            $query->pesquisar($search);
        }
        return $query->paginate($limite);
    }
}
