<?php

declare(strict_types=1);

namespace App\Services\Food;

use App\Facades\FilterableFacade;
use App\Models\Food;
use Illuminate\Pagination\LengthAwarePaginator;

class FoodSearchService
{
    public function execute(
        array $filters,
        array $orders,
        int $limite = 10
    ): LengthAwarePaginator
    {
        $foodModel = new Food;
        return FilterableFacade::search($foodModel, [
            'filters' => $filters,
            'orders' => $orders
        ])->paginate($limite);
    }
}
