<?php

namespace Heseya\Searchable\Searches;

use Illuminate\Database\Eloquent\Builder;

abstract class Search
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param string $key
     * @param mixed|null $value
     */
    public function __construct(string $key, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    abstract public function query(Builder $query): Builder;
}
