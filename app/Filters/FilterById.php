<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FilterById
{
    public function apply(Builder $query, mixed $value): void
    {
        $query->where('id', $value);
    }
}