<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;

interface ProviderInterface
{
    public function getQuery(): Builder|QueryBuilder|Relation;

    public function search(Builder|QueryBuilder|Relation $query, string $search): void;

    public function sort(Builder|QueryBuilder|Relation $query, string $column, string $direction): void;
}
