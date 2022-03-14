<?php

namespace Heseya\Searchable\Traits;

use Exception;
use Heseya\Searchable\Criteria\Criterion;
use Heseya\Searchable\Criteria\Equals;
use Illuminate\Database\Eloquent\Builder;

trait HasCriteria
{
    /**
     * Get default search type.
     *
     * @return string Class name
     */
    protected function getDefaultCriterion(): string
    {
        return Equals::class;
    }

    /**
     * Get searchable fields.
     *
     * @return array
     */
    protected function getCriteria(): array
    {
        return $this->criteria ?? [];
    }

    /**
     * @param Builder $query
     * @param array $params
     *
     * @throws Exception
     *
     * @return Builder
     */
    public function scopeSearchByCriteria(Builder $query, array $params = []): Builder
    {
        foreach ($params as $key => $value) {
            if (!$this->isParamSearchable($key)) {
                continue;
            }

            $search = $this->getCriterion($key, $value);

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
     * @return Criterion
     */
    private function getCriterion(string $key, $value): Criterion
    {
        $criterion = $this->getParamClass($key);

        if (!is_subclass_of($criterion, Criterion::class)) {
            throw new Exception("$criterion must be instance of Criterion");
        }

        return new $criterion($key, $value);
    }

    /**
     * @param string $param
     *
     * @return bool
     */
    private function isParamSearchable(string $param): bool
    {
        return array_key_exists(
            $param,
            $this->getCriteria(),
        ) || in_array(
            $param,
            $this->getCriteria(),
        );
    }

    /**
     * @param string $param
     *
     * @return string
     */
    private function getParamClass(string $param): string
    {
        return $this->getCriteria()[$param] ?? $this->getDefaultCriterion();
    }
}
