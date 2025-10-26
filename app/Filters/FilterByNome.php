<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FilterByNome
{
    public function apply(Builder $query, mixed $value): void
    {
        $query->where('nome', 'regexp', $value);
    }
}