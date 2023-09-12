<?php

namespace App\Models\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use function array_filter;
use function explode;
use function str_contains;

trait SearchableTrait
{
    abstract public function getSearchableColumns(): array;

    /**
     * @param Builder|QueryBuilder|Relation $query
     * @param string $search
     * @param $columns
     * @return void
     * @throws Exception
     */
    public function search(Builder|QueryBuilder|Relation $query, string $search,  $columns = null): void
    {
        $words = explode(' ', $search);
        $words = array_filter($words);

        if (!$columns) {
            $columns = $this->getSearchableColumns();
        }

        $query->where(function ($query) use ($words, $columns) {
            foreach ($words as $word) {
                $query->where(function ($query) use ($word, $columns) {
                    foreach ($columns as $column) {
                        if (str_contains($column, '.')) {
                            [$relation, $column] = explode('.', $column);
                            $query->orWhereHas($relation, function ($query) use ($column, $word) {
                                $query->where($column, 'like', '%' . $word . '%');
                            });
                        } else {
                            $query->orWhere($this->getTable() . '.' . $column, 'like', '%' . $word . '%');
                        }
                    }
                });
            }
        });
    }
}