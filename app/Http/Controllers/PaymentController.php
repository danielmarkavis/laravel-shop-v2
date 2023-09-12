<?php

namespace App\Http\Controllers;

use App\Services\PaymentServiceInterface;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartService $cart): Response|ResponseFactory
    {
        $products = $cart->get();
        $total = $cart->totalPrice();
        return inertia('Payment/Index', ['products' => array_values($products), 'total' => $total]);
    }

    public function store(CartService $cart, PaymentServiceInterface $paymentGateway, OrderService $orderService): RedirectResponse
    {
        $status = $paymentGateway->execute();

        $orderComplete = $orderService->getSessionOrder();

        if (!$orderComplete) {
            return redirect()->route('orders.index');
        }

        $orderComplete->status = $status;
        $orderComplete->save();

        $cart->purge();
        $orderService->purgeSession();

        return redirect()->route('payment.show', ['order' => $orderComplete->uuid]);
    }

    public function show(Order $order): Response|ResponseFactory
    {
        $order = $order->load(['orderProducts.variant.product','address']);

        return inertia('Payment/Show', compact('order'));
    }

}
