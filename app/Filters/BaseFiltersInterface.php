<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

interface BaseFiltersInterface
{
    public function apply(Builder $query, $filters): Builder;
}