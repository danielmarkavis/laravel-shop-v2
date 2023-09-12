<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Repositories\ProductsIndex;
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
        $product->load(['variants']);

//        $colours = Variant::select(['variants.size','variants.sku'])->where('product_id', $product->id)->distinct('variants.size')->get();//->pluck(['size','sku']);
//        dd($colours);
        $variants = $product->variants;

        $colours = [];
        foreach($variants as $variant) {
            $colours[$variant->colour][$variant->size] = $variant;
        }

        //Todo: set a default product??
        return inertia('Products/Show', compact('product', 'colours'));
    }

}
