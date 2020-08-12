<?php

namespace Heseya\Searchable\Searches;

use Illuminate\Database\Eloquent\Builder;

final class Equals extends Search
{
    public function query(Builder $query): Builder
    {
        return $query->where($this->key, $this->value);
    }
}
