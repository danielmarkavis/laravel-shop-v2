<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Inertia\Response;
use Inertia\ResponseFactory;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderService $orderService): Response|ResponseFactory
    {
        $orders = $orderService->all();

        return inertia('Orders/Index', compact('orders'));
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Order $order): Response|ResponseFactory
    {
        $order = $order->load(['orderProducts.variant.product','address']);

        return inertia('Orders/Show', compact('order'));
    }

}
