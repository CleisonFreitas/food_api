<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface FilterableContract
{
    /**
     * Será utilizado na aplicação de pipelines para filtrar e ordenar valores.
     * 
     * @param Model $modelo
     * @param array<string, mixed> $params ['filters' => [], 'orders' => []]
     * @return Builder
     */
    public function search(Model $modelo, array $params): Builder;
}