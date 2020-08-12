<?php

namespace Heseya\Searchable\Searches;

use Illuminate\Database\Eloquent\Builder;

final class Like extends Search
{
    public function query(Builder $query): Builder
    {
        return $query->where($this->key, 'LIKE', '%' . $this->value . '%');
    }
}
