<?php

namespace App\Models\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use function in_array;

trait SortableTrait
{
    abstract public function getSortableColumns(): array;

    /**
     * @param Builder|QueryBuilder|Relation $query
     * @param string $column
     * @param string $direction
     * @return void
     * @throws Exception
     */
    public function sort(Builder|QueryBuilder|Relation $query, string $column, string $direction): void
    {
        if (!in_array($column, self::getSortableColumns())) {
            throw new Exception($column);
        }
        $query->orderBy($column, $direction === 'desc' ? 'desc' : 'asc');
    }
}