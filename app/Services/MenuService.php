<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class MenuService
{
    protected ?User $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function generate(): array
    {
        return [
            [
                'label' => 'Home',
                'route' => 'products.index'
            ],
            [
                'label' => 'Products',
                'route' => 'products.index'
            ],
            [
                'label' => 'Cart',
                'route' => 'cart.index'
            ]
        ];
    }
}
