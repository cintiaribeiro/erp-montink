<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {}

    public function index()
    {
        return $this->orderService->allOrders();
    }

    public function show(Order $order)
    {
        return $this->orderService->showOrder($order);
    }

    public function store(Request $request)
    {
        return $this->orderService->storeOrder($request);
    }
}
