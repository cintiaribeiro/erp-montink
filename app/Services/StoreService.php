<?php

namespace App\Services;

use App\Models\Product;

class StoreService
{
    public function __construct(private Product $product)
    {}
    public function index()
    {
        $products = $this->product->all();
        return view('stores.index', compact('products'));
    }

    public function details($product)
    {
        return view('stores.details', compact('product'));
    }
}
