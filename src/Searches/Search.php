<?php

namespace Heseya\Searchable\Searches;

use Illuminate\Database\Eloquent\Builder;

abstract class Search
{
    /**
     * @var string $key
     */
    protected $key;

    /**
     * @var mixed $value
     */
    protected $value;

    /**
     * @param string $key
     * @param mixed|null $value
     */
    function __construct (string $key, $value = null)
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
