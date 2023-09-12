<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;

class OrdersIndex implements ProviderInterface
{
    public function getQuery(): Builder|QueryBuilder|Relation
    {
        return Order::select([
            'order.id',
            'order.uuid',
            'order.subtotal',
            'order.vat',
            'order.total',
            'order.status',
        ])
            ->with(['address']);
    }

    /**
     * @throws \Exception
     */
    public function search(Relation|Builder|QueryBuilder $query, string $search): void
    {
        (new Order)->search( $query, $search );
    }

    /**
     * @throws \Exception
     */
    public function sort(Builder|QueryBuilder|Relation $query, string $column, string $direction): void
    {
        (new Order)->sort( $query, $column, $direction );
    }
}
