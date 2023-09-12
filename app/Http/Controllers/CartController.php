<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Services\CartServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Response;
use Inertia\ResponseFactory;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartServiceInterface $cart): Response|ResponseFactory
    {
        $products = $cart->get();
        $total = $cart->totalPrice();

        return inertia('Cart/Index', ['products'=>array_values($products),'total'=>$total]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Variant $variant, CartServiceInterface $cart): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $cart->store($variant);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $sku, CartServiceInterface $cart): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $cart->destroy($sku);

        return redirect()->route('cart.index')->with('success', 'Product delete from cart!');
    }
}
