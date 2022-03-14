<?php

namespace Heseya\Searchable\Criteria;

use Illuminate\Database\Eloquent\Builder;

final class Equals extends Criterion
{
    public function query(Builder $query): Builder
    {
        return $query->where($this->key, $this->value);
    }
}
