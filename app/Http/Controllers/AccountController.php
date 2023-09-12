<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Inertia\Response;
use Inertia\ResponseFactory;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderService $orderService): Response|ResponseFactory
    {
        $orders = $orderService->all();

        return inertia('Account/Index', compact('orders'));
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Order $order): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('pages.account.show', compact('order'));
    }

}
