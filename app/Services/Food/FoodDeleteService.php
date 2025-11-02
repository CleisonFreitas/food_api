<?php

declare(strict_types=1);

namespace App\Services\Food;

use App\Models\Prato;

class FoodDeleteService
{
    public function execute(Prato $prato): Prato
    {
        $prato->delete();
        return $prato->refresh();
    }
}
