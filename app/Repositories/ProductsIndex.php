<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ProductsIndex implements ProviderInterface
{
    public function getQuery(): Builder|QueryBuilder|Relation
    {
        return Product::select([
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.sale_price',
            'products.sku',
        ])
            ->with(['media']);
    }

    /**
     * @throws \Exception
     */
    public function search(Relation|Builder|QueryBuilder $query, string $search): void
    {
        (new Product)->search( $query, $search );
    }

    /**
     * @throws \Exception
     */
    public function sort(Builder|QueryBuilder|Relation $query, string $column, string $direction): void
    {
        (new Product)->sort( $query, $column, $direction );
    }
}
