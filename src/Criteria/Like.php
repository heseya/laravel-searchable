<?php

namespace Heseya\Searchable\Criteria;

use Illuminate\Database\Eloquent\Builder;

final class Like extends Criterion
{
    public function query(Builder $query): Builder
    {
        return $query->where($this->key, 'LIKE', '%' . $this->value . '%');
    }
}
