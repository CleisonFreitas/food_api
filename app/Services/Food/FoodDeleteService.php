<?php

declare(strict_types=1);

namespace App\Services\Food;

use App\Models\Food;

class FoodDeleteService
{
    public function execute(Food $food): Food
    {
        $food->delete();
        return $food->refresh();
    }
}
