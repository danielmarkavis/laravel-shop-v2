<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutStoreRequest;
use App\Models\Address;
use App\Services\AddressService;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(CartService $cart): Response|ResponseFactory
    {
        $products = $cart->get();
        $total = $cart->totalPrice();

        $addresses = Address::where('user_id', auth()->user()->id)->get();

        return inertia('Checkout/Index', ['products' => array_values($products), 'total' => $total, 'addresses' => $addresses]);
    }

    public function store(CheckoutStoreRequest $request, CartService $cart, AddressService $address, OrderService $order): RedirectResponse
    {
        $data = $request->validated();

        if ($data['address_id'] === -1) {
            $shippingAddress = $address->store($data);
        } else {
            $shippingAddress = $address->getById($data['address_id']);
        }

        $order->store($cart, $shippingAddress);
        return redirect()->route('payment.index');
    }

}
