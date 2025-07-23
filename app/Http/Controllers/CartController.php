<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService,
    )
    {
    }

    public function show()
    {
        return $this->cartService->showCart();
    }

    public function add(Request $request)
    {
        return $this->cartService->addCart($request);
    }

    public function finish()
    {
        return $this->cartService->finishCart();
    }

}
