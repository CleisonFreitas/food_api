<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterableContract
{
    /**
     * Será utilizado na aplicação de pipelines para filtrar e ordenar valores.
     * 
     * @param Builder $query
     * @param array<string, mixed> $params ['filters' => [], 'orders' => []]
     * @return Builder
     */
    public function search(Builder $query, array $params): Builder;
}