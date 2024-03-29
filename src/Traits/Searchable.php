<?php

namespace Heseya\Searchable\Traits;

use Exception;
use Heseya\Searchable\Searches\Equals;
use Heseya\Searchable\Searches\Search;
use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Get default search type.
     *
     * @return string Class name
     */
    protected function getDefaultSearchType(): string
    {
        return Equals::class;
    }

    /**
     * Get searchable fields.
     *
     * @return array
     */
    protected function getSearchable(): array
    {
        return $this->searchable ?? [];
    }

    /**
     * @param Builder $query
     * @param array $params
     *
     * @throws Exception
     *
     * @return Builder
     */
    public function scopeSearch(Builder $query, array $params = []): Builder
    {
        foreach ($params as $key => $value) {
            if (!$this->isParamSearchable($key)) {
                continue;
            }

            $search = $this->getSearchType($key, $value);

            $query = $search->query($query);
        }

        return $query;
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @throws Exception
     *
     * @return Search
     */
    private function getSearchType(string $key, $value): Search
    {
        $search = $this->getParamClass($key);

        if (!is_subclass_of($search, Search::class)) {
            throw new Exception($search . ' must be instance of SearchType');
        }

        return new $search($key, $value);
    }

    /**
     * @param string $param
     *
     * @return bool
     */
    private function isParamSearchable(string $param): bool
    {
        return array_key_exists($param, $this->getSearchable()) || in_array($param, $this->getSearchable());
    }

    /**
     * @param string $param
     *
     * @return string
     */
    private function getParamClass(string $param): string
    {
        return $this->getSearchable()[$param] ?? $this->getDefaultSearchType();
    }
}
