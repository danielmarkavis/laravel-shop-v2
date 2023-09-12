<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductsIndex;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductsIndex $provider): Response|ResponseFactory
    {
        $products = $provider
            ->getQuery()
            ->get();

        return inertia('Products/Index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response|ResponseFactory
    {
        $variants = $product->variants;

        $colours = [];

        foreach($variants as $variant) {
            $colours[$variant->colour][$variant->size] = $variant;
        }

        //Todo: set a default product??
        return inertia('Products/Show', compact('product', 'variants', 'colours'));
    }

}
