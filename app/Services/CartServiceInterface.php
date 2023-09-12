<?php

namespace App\Services;

use App\Models\Variant;

interface CartServiceInterface
{
    public function store(Variant $variant): void;
    public function destroy(string $sku): void;
    public function get();

    public function totalPrice():int;
}